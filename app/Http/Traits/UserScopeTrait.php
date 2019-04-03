<?php
namespace App\Http\Traits;

use App\Http\Scopes\UserScope;

trait UserScopeTrait {

    /**
     * Boot the scope.
     *
     * @return void
     */
    public static function bootUserScopeTrait()
    {
        static::addGlobalScope(new UserScope);
    }

    /**
     * Get the name of the column for applying the scope.
     *
     * @return string
     */
    public function  getUserColumn()
    {
        return defined('static::USER_COLUMN') ? static::USER_COLUMN : 'user_id';
    }

    /**
     * Get the fully qualified column name for applying the scope.
     *
     * @return string
     */
    public function getQualifiedUserColumn()
    {
        return $this->getTable().'.'.$this->getUserColumn();
    }

    /**
     * Get the query builder without the scope applied.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function AllUsers()
    {
        return with(new static)->newQueryWithoutScope(new UserScope);
    }
}