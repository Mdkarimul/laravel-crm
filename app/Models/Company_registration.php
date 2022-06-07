<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'company_slug',
        "tagline",
        "website",
        "company_email",
        "founder",
        "founder_email",
        "contact_number",
        "street_address",
        "city",
        "state",
        "country",
        "pin_code",
        "gstin",
        "office_start_at",
        "office_end_at",
        "company_estd",
        "facebook_url",
        "twitter_url",
        "whats_app",
        "category",
        "erp_url",
        "password"
    ];
}
