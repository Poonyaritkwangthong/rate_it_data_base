<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'user_name',
        'password',
        'role',
        'group_num',
        'job_position_num',
        'job_type_num',
        'tier_num',
        'work_affiliation_num',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ratedPersonals()
    {
        return $this->belongsToMany(PersonalScore::class, 'personal_score', 'user_num', 'personal_num');
    }

    public function Group()
    {
        return $this->belongsTo(Group::class, 'group_num');
    }
    public function JobPosition()
    {
        return $this->belongsTo(JobPosition::class, 'job_position_num');
    }
    public function JobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_num');
    }
    public function Tier()
    {
        return $this->belongsTo(Tier::class, 'tier_num');
    }
    public function WorkAffiliation()
    {
        return $this->belongsTo(WorkAffiliation::class, 'work_affiliation_num');
    }

    public function rateIts()
    {
        return $this->hasMany(PersonalScore::class, 'personal_num', 'id');
    }

    public function HeadShipRatedPersonals01()
    {
        return $this->belongsToMany(Assessment01Score::class, 'personal_score', 'user_num', 'personal_num');
    }
    public function assessment01()
    {
        return $this->hasMany(Assessment01Score::class, 'personal_num', 'id');
    }
    public function HeadShipRatedPersonals02()
    {
        return $this->belongsToMany(Assessment02Score::class, 'personal_score', 'user_num', 'personal_num');
    }
    public function assessment02()
    {
        return $this->hasMany(Assessment02Score::class, 'personal_num', 'id');
    }

    public function getRoundAttribute()
    {
        $now = Carbon::now();
        $startRound1 = Carbon::create($now->year, 3, 1); // เริ่ม 1 มีนาคม
        $endRound1 = Carbon::create($now->year, 9, 30); // จบ 30 กันยายน
        $startRound2 = Carbon::create($now->month < 3 ? $now->year - 1 : $now->year, 10, 1); // เริ่ม 1 ตุลาคม
        $endRound2 = Carbon::create($now->month < 3 ? $now->year : $now->year + 1, 2, 28); // จบ 28 กุมภาพันธ์

        // $startRound1 = Carbon::create($now->year, 1, 1); // เริ่ม 1 มกราคม
        // $endRound1 = Carbon::create($now->year, 6, 30); // จบ 30 มิถุนายน
        // $startRound2 = Carbon::create($now->year, 7, 1); // เริ่ม 1 กรกฎาคม
        // $endRound2 = Carbon::create($now->year, 12, 31); // จบ 31 ธันวาคม


        if ($now->between($startRound1, $endRound1)) {
            return 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            return 2;
        }

        return null;
    }

    public function HeadShipSummarize01()
    {
        return $this->belongsToMany(SummarizePart01::class, 'summarize_part_01', 'evaluation_num', 'personal_num');
    }
    public function Summarize01()
    {
        return $this->hasMany(SummarizePart01::class, 'personal_num', 'id');
    }
    public function HeadShipSummarize02()
    {
        return $this->belongsToMany(SummarizePart02::class, 'summarize_part_02', 'evaluation_num', 'personal_num');
    }
    public function Summarize02()
    {
        return $this->hasMany(SummarizePart02::class, 'personal_num', 'id');
    }
    public function HeadShipSummarize03()
    {
        return $this->belongsToMany(SummarizePart03::class, 'summarize_part_03', 'evaluation_num', 'personal_num');
    }
    public function Summarize03()
    {
        return $this->hasMany(SummarizePart03::class, 'personal_num', 'id');
    }
    public function AboveComment()
    {
        return $this->belongsToMany(AboveComment::class, 'above_comments', 'above_num', 'personal_num');
    }
    public function AboveSummarize()
    {
        return $this->hasMany(AboveComment::class, 'personal_num', 'id');
    }
    public function FurtherComment()
    {
        return $this->belongsToMany(FurtherComment::class, 'further_comments', 'further_num', 'personal_num');
    }
    public function FurtherSummarize()
    {
        return $this->hasMany(FurtherComment::class, 'personal_num', 'id');
    }
}
