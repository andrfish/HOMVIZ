<?php

namespace App;

use Auth;
use App\Job;
use App\User;
use App\Admin;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;



class User extends Model implements
AuthenticatableContract, CanResetPasswordContract
{
      use Authenticatable, CanResetPassword, SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public static $registration = array(
        'username'=>'required|unique:users',
        'email'=>'required|email|unique:users',
        'password'=>'required|between:6,25|',
        'password_again'=>'required|between:6,25',
        'phone'=>'required'
    );


    public static $rules_password_reset = array(
        'email'=>'required|email|unique:users',
        'password'=>'required|between:6,25|',
        'password_confirmation'=>'required|between:6,25'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password'];

    /*
    |--------------------------------------------------------------------------
    | ACL Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Checks a Permission
     *
     * @param  String permission Slug of a permission (i.e: manage_user)
     * @return Boolean true if has permission, otherwise false
     */
    public function can($permission = null)
    {


        return !is_null($permission) && $this->checkPermission($permission);

    }

    /**
     * Check if the permission matches with any permission user has
     *
     * @param  String permission slug of a permission
     * @return Boolean true if permission exists, otherwise false
     */
    protected function checkPermission($perm)
    {
        $UserRole = RoleUser::where('user_id',Auth::user()->id)->first();
        if ($UserRole->role_id==1) {//before check
            $grant_access = true;
            return $grant_access;
        }
        
        $grant_access = false;
        $permissions = $this->getUserPermission(); // Returns a list of permission slugs for the specified user role
        $permissionArray = is_array($perm) ? $perm : [$perm]; // Returns uri of current page as an array
        foreach ($permissionArray as $uri) {
            if($permissions) {
                foreach ($permissions as $p) {
                    if($uri == $p) {
                        $grant_access = true;
                        break;
                    }
                }
            }
        }
    
        return $grant_access;
    }

    /**
     * Get all permission slugs from all permissions of all roles
     *
     * @return Array of permission slugs
     */
    protected function getUserPermission()
    {
        $permissions = [];
        //GET USER ID
        $this_user_id = Auth::user()->id;
        //GET USER ROLE
        
        $this_role = RoleUser::where('user_id',$this_user_id)->first();  
        $permission_role = PermissionRole::where('role_id',$this_role->role_id)->get();
        if($permission_role){
            foreach ($permission_role as $pr_key => $pr_value) {
                $_permission = Permission::find($pr_value->permission_id);
                $permissions[$pr_key] = $_permission->permission_slug;

            }  
        }

        // return $permissions?$permissions->permission_slug:false;
        return $permissions;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */
   
    /**
     * Many-To-Many Relationship Method for accessing the User->roles
     *
     * @return QueryBuilder Object
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    static public function updateValidation() {
        $current_user = Auth::user()->id;
            return $update = array(
                'email'=>'',
                'fname'=>'required|alpha|min:2',
                'lname'=>'required|alpha|min:2'
             );
        }

    static public function CheckForProfileImage() {
            $data = 'empty';
            if (Auth::check()) {
                $this_user = User::find(Auth::user()->id);
                $data = Job::imageValidator($this_user->profile_image);
            } else {
                $data = Job::imageValidator($data);
            }
            return $data;
        }


    public static function search_by() {
            return array(
                ''          => 'Search users by',
                'id'        => 'user id',
                'phone'      => 'phone',
                'username'  => 'username',
                'email'     => 'email',
                'name'      => 'full name'
                );
        }

    public static function PrepareUsersData($data) {
        $html = '';
        if(isset($data)) {
            foreach ($data as $key => $value) {
                $address_array = json_decode($value->address_array,true);
                $html .= '<tr class="table-tr" user_id="'.$value->id.'" style="cursor:pointer">';
                $html .= '<td>'.$value->id.'</td>';
                $html .= '<td>'.$value->username.'</td>';
                $html .= '<td class="first_name">'.$value->firstname.'</td>';
                $html .= '<td>'.$value->lastname.'</td>';
                $html .= '<td class="email">'.$value->email.'</td>';
                $html .= '<td class="hide last_name">'.$value->lastname.'</td>';
                $html .= '<td class="hide phone">'.$value->phone.'</td>';
                $html .= '<td class="hide postcode">'.$address_array['postcode'].'</td>';
                $html .= '<td class="hide korean_new_address">'.$address_array['korean_new_address'].'</td>';
                $html .= '<td class="hide korean_old_address">'.$address_array['korean_old_address'].'</td>';
                $html .= '<td class="hide english_address_address">'.$address_array['english_address_address'].'</td>';
                $html .= '<td class="hide details">'.$address_array['details'].'</td>';
                $html .= '<td><a href="'.route("users_edit",$value->id).'">Edit</a></td>';
                $html .= '</tr>';
            }
        }

        return $html;
    }
    public static function PrepareUsersDataInvoice($data) {
        $html = '';
        if(isset($data)) {
            foreach ($data as $key => $value) {
                $html .= '<tr class="table-tr" style="cursor:pointer">';
                $html .= '<td>'.$value->id.'</td>';
                $html .= '<td>'.$value->username.'</td>';
                $html .= '<td>'.$value->firstname.'</td>';
                $html .= '<td>'.$value->lastname.'</td>';
                $html .= '<td>'.$value->email.'</td>';
                $html .= '<td> <div class="checkbox">
                                    <label>
                                      <input type="checkbox" class="invoice-customer" customer_id="'.$value->id.'"> Select User
                                    </label>
                                </div>
                          </td>';
                $html .= '</tr>';
            }
        }

        return $html;
    }
}
