<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $account_id
 * @property-read \App\Models\Account|null $account
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Area
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property mixed $coordinates
 * @property int|null $account_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Account|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Zone[] $zones
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereCoordinates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereUpdatedAt($value)
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Zone
 *
 * @property int $id
 * @property string $name
 * @property string $crop
 * @property mixed $coordinates
 * @property int|null $area_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SensorNode[] $sensorNodes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zone whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zone whereCoordinates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zone whereCrop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zone whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zone whereUpdatedAt($value)
 */
	class Zone extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Area[] $areas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SensorNode[] $sensorNodes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Zone[] $zones
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereUpdatedAt($value)
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SensorNode
 *
 * @property int $id
 * @property string $name
 * @property int|null $zone_id
 * @property int|null $account_id
 * @property string $type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\Zone|null $zone
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorNode whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorNode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorNode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorNode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorNode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorNode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorNode whereZoneId($value)
 */
	class SensorNode extends \Eloquent {}
}

