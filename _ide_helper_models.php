<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Backup
 *
 * @property int $id
 * @property string $name
 * @property string $file_date_time
 * @property int $size
 * @property string $target
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Backup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Backup whereFileDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Backup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Backup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Backup whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Backup whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Backup whereUpdatedAt($value)
 */
	class Backup extends \Eloquent {}
}

namespace App{
/**
 * App\Log
 *
 * @property int $id
 * @property string $file_date_time
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereFileDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereUpdatedAt($value)
 */
	class Log extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

