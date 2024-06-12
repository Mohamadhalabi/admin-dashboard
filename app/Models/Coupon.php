<?php

namespace App\Models;

use App\Mail\SendCouponNotification;
use App\Notifications\CouponNotification;
use App\Traits\SerializeDateTrait;
use App\Traits\SetMailConfigurations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Mockery\Matcher\Not;
use PhpParser\Node\Stmt\While_;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SerializeDateTrait;
    use SetMailConfigurations;
    use LogsActivity;

    public static $Order = "Order";
    public static $Product = "Product";
    public static $Amount = "Amount";
    public static $Percentage = "Percentage";

    protected $casts = [
        'products_ids' => 'array'
    ];

    protected $fillable = ['code', 'discount', 'discount_type', 'type', 'minimum_shopping', 'products_ids', 'free_shipping', 'starts_at', 'ends_at', 'max_use', 'per_user'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::created(function ($model) {

            $receivers['admins'] = Admin::query()->where('status', 1)->get();

            if ($model->type == Coupon::$Product && $model->max_use != 1) {

                $users = Wishlist::query()->whereIn('product_id', $model->products_ids)->groupBy('user_id')->pluck('user_id');
                $users_2 = Cart::query()->whereIn('product_id', $model->products_ids)->groupBy('user_id')->pluck('user_id');

                $data['coupon'] = $model;
                $data['products'] = Product::whereIn('id', $model->products_ids)->get();

                $users_ids = array_unique(array_merge($users->toArray(), $users_2->toArray()), SORT_REGULAR);
                $receivers = User::query()->whereIn('id', $users_ids)->chunk(50, function ($receivers) use ($data) {
                    $seller_emails = User::query()
                        ->select('sellers.email')
                        ->join('sellers', 'sellers.id', 'users.seller_id')
                        ->where('sellers.status', 1)
                        ->where('users.status', 1)
                        ->groupBy('sellers.email')->pluck('sellers.email');
                    foreach ($receivers as $index => $receiver) {

                        Mail::to($receiver)->bcc($seller_emails)->later(now()->addMinutes($index + 1), new SendCouponNotification('New Coupon', $data));

                    }
                });

            }

        });
    }

    public function coupon_usage()
    {
        return $this->belongsToMany(CouponUsages::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function is_valid()
    {
        $coupon_usages = CouponUsages::query()->where('coupon_id', $this->id);

        return ($this->starts_at <= date('Y-m-d H:i:s')
            && $this->ends_at >= date('Y-m-d H:i:s')
            && $this->status && $coupon_usages->count() < $this->max_use
            && $coupon_usages->where('user_id', auth('api')->id())->count() < $this->per_user
        );

    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}