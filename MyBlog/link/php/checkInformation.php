<?php

class checkInformation
{
public $sqlHost;
public $sqlUser;
public $sqlPassword;
public $sqLDatabase;
public $sqlQuery;

    /**
     * @return mixed
     */
    public function getSqLDatabase()
    {
        return $this->sqLDatabase;
    }
    /**
     * @return mixed
     */
    public function getSqlHost()
    {
        return $this->sqlHost;
    }
    /**
     * @return mixed
     */
    public function getSqlPassword()
    {
        return $this->sqlPassword;
    }

    /**
     * @return mixed
     */
    public function getSqlUser()
    {
        return $this->sqlUser;
    }

    /**
     * @return mixed
     */
    public function getSqlQuery()
    {
        return $this->sqlQuery;
    }

    /**
     * @param mixed $sqLDatabase
     */
    public function setSqLDatabase($sqLDatabase)
    {
        $this->sqLDatabase = $sqLDatabase;
    }

    /**
     * @param mixed $sqlHost
     */
    public function setSqlHost($sqlHost)
    {
        $this->sqlHost = $sqlHost;
    }

    /**
     * @param mixed $sqlPassword
     */
    public function setSqlPassword($sqlPassword)
    {
        $this->sqlPassword = $sqlPassword;
    }

    /**
     * @param mixed $sqlQuery
     */
    public function setSqlQuery($sqlQuery)
    {
        $this->sqlQuery = $sqlQuery;
    }

    /**
     * @param mixed $sqlUser
     */
    public function setSqlUser($sqlUser)
    {
        $this->sqlUser = $sqlUser;
    }

    /**
     * 查询数据库数据，用于判断用户的信息。
     * 返回的是true & false
     */
    public function select_sql(){
        $con=mysqli_connect($this->getSqlHost(),$this->getSqlUser(),$this->getSqlPassword(),$this->getSqLDatabase());
        $sqlSelect=mysqli_query($con,$this->getSqlQuery());
        //判断数据库是否连接成功
        if ($con){
            //判断是否查询到内容
            if (mysqli_num_rows($sqlSelect)>0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /**
     * 获取数据库的信息
     * 返回的是mysqli_query()的数据用mysqli_fetch_array()来逐条读取
     * 连接异常或者查询不到数据时候返回 false
     */
    public function get_sql_information(){
        $con=mysqli_connect($this->getSqlHost(),$this->getSqlUser(),$this->getSqlPassword(),$this->getSqLDatabase());
        $sqlSelect=mysqli_query($con,$this->getSqlQuery());
        //判断数据库是否连接成功
        if ($con){
            //判断是否查询到内容
            if (mysqli_num_rows($sqlSelect)>0){
                return $sqlSelect;//返回查询后的数据
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /**
     * 向数据库执行删除信息
     * 返回的是 true & false
     */
    public function delete_sql(){
        $con=mysqli_connect($this->getSqlHost(),$this->getSqlUser(),$this->getSqlPassword(),$this->getSqLDatabase());
        $sqlDelete=mysqli_query($con,$this->getSqlQuery());
        //判断数据库是否连接成功
        if ($con){
            //判断是否删除成功
            if (mysqli_affected_rows($con)>0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /**
     *向数据库执行更新信息
     * 返回的是 true & false
     */
    public function update_sql(){
        $con=mysqli_connect($this->getSqlHost(),$this->getSqlUser(),$this->getSqlPassword(),$this->getSqLDatabase());
        $sqlUpdate=mysqli_query($con,$this->getSqlQuery());
        //判断数据库是否连接成功
        if ($con){
            //判断是更新除成功
            if (mysqli_affected_rows($con)>0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /**
     * 向数据库执行插入的信息
     * 返回的是 true & false
     */
    public function insert_sql(){
        $con=mysqli_connect($this->getSqlHost(),$this->getSqlUser(),$this->getSqlPassword(),$this->getSqLDatabase());
        $sqlInsert=mysqli_query($con,$this->getSqlQuery());
        //判断数据库是否连接成功
        if ($con){
            //判断是修插入成功
            if (mysqli_affected_rows($con)>0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

