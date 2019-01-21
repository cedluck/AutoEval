<?php

namespace App\Repositories;

use App\User;

class UserRepository
{

    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Saves input data in db
     * @param User $user
     * @param array $inputs
     */
    private function save(User $user, Array $inputs)
    {
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->teacher = '1';


        $user->save();
    }

    /**
     * get the paginate variable
     * @param $n
     * @return mixed
     */
    public function getPaginate($n)
    {
        return $this->user->paginate($n);
    }

    public function store(Array $inputs)
    {
        $user = new $this->user;
        $user->password = bcrypt($inputs['password']);

        $this->save($user, $inputs);

        return $user;
    }

    public function getById($id)
    {
        return $this->user->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
        $this->save($this->getById($id), $inputs);
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }
}