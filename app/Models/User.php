<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'tbl_users';

    // 👇 if your primary key is NOT "id"
    protected $primaryKey = 'user_ID';

    // 👇 if your PK is NOT auto-increment
    public $incrementing = false;

    // 👇 if your PK is a string (like varchar)
    protected $keyType = 'string';
    protected $fillable = [
        'user_ID',
        'user_Fname',
        'user_Lname',
        'user_MI',
        'user_Email',
        'user_Access',
        'user_Password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'user_Password',
        'remember_token',
    ];
    public function getAuthPassword()
    {
        return $this->user_Password;
    }

    public function getKeyName(){
        return 'user_ID';
    }

    public function classifications()
    {
        return $this->hasOne(Classification::class, 'user_ID', 'user_ID');
    }
    public function username()
    {
        return 'user_ID';
    }
    public function researchInformation()
    {
        return $this->hasOne(ResearchInformation::class, 'user_ID', 'user_ID');
    }
    public function forms()
    {
        return $this->belongsToMany(FormsTable::class, 'tbl_form_user', 'user_ID', 'form_id')
                    ->withTimestamps();
    }
    public function researchFiles(){
        return $this->hasMany(ResearchFiles::class, 'user_ID', 'user_ID');
    }

    public function submissionForms()
    {
        return $this->forms()->where('form_type', 'Submission');
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            //'email_verified_at' => 'datetime',
            //'password' => 'hashed',
        ];
    }

    public function form2bs()
    {
        return $this->hasMany(Form2B::class, 'user_ID', 'user_ID');
    }

    public function getFullNameAttribute()
    {
        // If middle initial exists, add it with a dot
        $mi = $this->user_MI ? "{$this->user_MI}." : '';

        return "{$this->user_Fname} {$mi} {$this->user_Lname}";
    }

    public function reviewerInformation()
    {
        return $this->hasOne(ReviewerInformation::class, 'user_ID', 'user_ID');
    }

    public function initialReviews()
    {
        return $this->hasMany(\App\Models\InitialReview::class, 'user_ID', 'user_ID');
    }
    public function protocol()
    {
        return $this->hasOne(\App\Models\Protocol::class, 'user_ID', 'user_ID');
    }
    public function approved()
    {
        return $this->hasMany(Approved::class, 'user_ID', 'user_ID');
    }

    public function assignReviewer()
    {
        return $this->hasMany(InitialReview::class, 'user_ID', 'user_ID');
    }

    // ✅ OPTIONAL - Relationships for when this user is assigned as a reviewer
    public function assignedAsReviewer1()
    {
        return $this->hasMany(InitialReview::class, 'reviewer1_ID', 'user_ID');
    }

    public function assignedAsReviewer2()
    {
        return $this->hasMany(InitialReview::class, 'reviewer2_ID', 'user_ID');
    }
}
