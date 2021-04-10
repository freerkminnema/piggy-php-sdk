<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Models\Member;

/**
 * Class MemberMapper
 * @package Piggy\Api\Mappers
 */
class MemberMapper
{
    /**
     * @param object $data
     * @return Member
     */
    public function map(object $data): Member
    {
        $member = new Member(
            $data->id,
            $data->email
        );

        return $member;
    }
}