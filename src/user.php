<?php
/**
 * Filippo Finke
 */
namespace FilippoFinke;

class User
{
    private $followers;
    private $follows;
    private $gender;
    private $is_private;
    private $is_verified;
    private $is_joined_recently;
    private $is_business_account;

    public function __construct($followers = null, $follows = null, $gender = null, $is_private = null, $is_verified = null, $is_joined_recently = null, $is_business_account = null)
    {
        $this->followers = $followers;
        $this->follows = $follows;
        $this->gender = $gender;
        $this->is_private = (int)$is_private;
        $this->is_verified = (int)$is_verified;
        $this->is_joined_recently = (int)$is_joined_recently;
        $this->is_business_account = (int)$is_business_account;
    }

    public function load($username)
    {
        $data = \file_get_contents("https://www.instagram.com/$username/?__a=1");
        $json = json_decode($data, true)["graphql"]["user"];

        $full_name = trim(preg_replace("/[^a-zA-Z ]+/", "", $json["full_name"]));
        $name = explode(" ", $full_name)[0];
        $gender = (new \GenderDetector\GenderDetector())->detect($name);
        if ($gender == "male") {
            $gender = 1;
        } elseif ($gender == "female") {
            $gender = 2;
        } else {
            $gender = 0;
        }

        $this->followers = $json["edge_followed_by"]["count"];
        $this->follows = $json["edge_follow"]["count"];
        $this->gender = $gender;
        $this->is_private = (int)$json["is_private"];
        $this->is_verified = (int)$json["is_verified"];
        $this->is_joined_recently = (int)$json["is_joined_recently"];
        $this->is_business_account = (int)$json["is_business_account"];
    }

    public function toArray()
    {
        return array(
            $this->followers,
            $this->follows,
            $this->gender,
            $this->is_private,
            $this->is_verified,
            $this->is_joined_recently,
            $this->is_business_account
        );
    }
}
