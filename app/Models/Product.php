<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Models;

use Mmrtonmoybd\Comment\Contracts\Commentable;
use Mmrtonmoybd\Comment\HasComments;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;
use willvincent\Rateable\Rateable;

class Product extends Model implements Commentable
{
    use HasComments;
    use Rateable;
    protected $fillable = ['category_id', 'title', 'price', 'discounds', 'description', 'quantity', 'admin_id', 'image', 'color', 'size'];
    /*
    protected $guarded = [
    'views'
    ];
    */

    public function category()
    {
        return $this->belongsTo('App\Models\Categorie', 'category_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }

    public static function order(int $id)
    {
        return \App\Models\Order::where('product_id', $id)->sum('quantity');
    }

    public function user(int $id)
    {
        return \App\Models\User::find($id);
    }

    public function adminCom(int $id)
    {
        return \App\Models\Admin::find($id);
    }

    // markdown affect view

    public static function getParse($value)
    {
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension());

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
            'html_input' => 'escape',
        ], $environment);

        return new HtmlString($converter->convertToHtml($value));
    }

    public function orderr()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * Registrates a visit into the database if it does not exist on current day
     * (Registers unique visitors).
     *
     * @param mixed $ip
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function visit($ip = '')
    {
        if (empty($ip)) {
            $ip = request()->ip();
        }

        return Visit::firstOrCreate([
            'ip' => $ip,
            'date' => Carbon::now()->toDateString(),

            'visitable_id' => $this->id,
            'visitable_type' => (new \ReflectionClass($this))->getName(),
        ]);
    }

    /**
     * Setting relationship.
     *
     * @return mixed
     */
    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    /**
     * Return count of the visits in the last day.
     *
     * @return mixed
     */
    public function visitsDay()
    {
        return $this->visitsLast(1);
    }

    /**
     * Return count of the visits in the last 7 days.
     *
     * @return mixed
     */
    public function visitsWeek()
    {
        return $this->visitsLast(7);
    }

    /**
     * Return count of the visits in the last 30 days.
     *
     * @return mixed
     */
    public function visitsMonth()
    {
        return $this->visitsLast(30);
    }

    /**
     * Return the count of visits since system was installed.
     *
     * @return mixed
     */
    public function visitsForever()
    {
        return $this->visits()
            ->count()
        ;
    }

    /**
     * Filter by popular in the last $days days.
     *
     * @param $query
     * @param $days
     *
     * @return mixed
     */
    public function scopePopularLast($query, $days)
    {
        return $this->queryPopularLast($query, $days);
    }

    /**
     * Filter by popular in the last day.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePopularDay($query)
    {
        return $this->queryPopularLast($query, 1);
    }

    /**
     * Filter by popular in the last 7 days.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePopularWeek($query)
    {
        return $this->queryPopularLast($query, 7);
    }

    /**
     * Filter by popular in the last 30 days.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePopularMonth($query)
    {
        return $this->queryPopularLast($query, 30);
    }

    /**
     * Filter by popular in the last 365 days.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePopularYear($query)
    {
        return $this->queryPopularLast($query, 365);
    }

    /**
     * Filter by popular in all time.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePopularAllTime($query)
    {
        return $query->withCount('visits')->orderBy('visits_count', 'desc');
    }

    /**
     * Return the visits of the model in the last ($days) days.
     *
     * @param mixed $days
     *
     * @return mixed
     */
    public function visitsLast($days)
    {
        return $this->visits()
            ->where('date', '>=', Carbon::now()->subDays($days)->toDateString())
            ->count()
        ;
    }

    /**
     * Returns a Query Builder with Model ordered by popularity in the Last ($days) days.
     *
     * @param $query
     * @param $days
     *
     * @return mixed
     */
    public function queryPopularLast($query, $days)
    {
        return $query->withCount(['visits' => function ($query) use ($days) {
            $query->where('date', '>=', Carbon::now()->subDays($days)->toDateString());
        }])->orderBy('visits_count', 'desc');
    }
}
