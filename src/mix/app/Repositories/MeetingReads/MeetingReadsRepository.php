<?php

namespace App\Repositories\MeetingReads;

use App\Repositories\MeetingReads\MeetingReadsRepositoryInterface;
use App\Models\MeetingReads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingReadsRepository implements MeetingReadsRepositoryInterface
{
    public function __construct(MeetingReads $meetingReads)
    {
        $this->meetingReads = $meetingReads;
    }
}
