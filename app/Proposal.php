<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use SoftDeletes;

    protected $table = 'proposals';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_type_id', 'customer_id', 'user_id', 'visit_id', 'pay_curr_id', 'pay_mode_id', 'pay_type_id',
        'code', 'name', 'version', 'term_weeks', 'serv_order', 'perc_fit', 'happen_at', 'changed_at', 'status'
    ];

    /**
     * Default values for attributes
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'version' => 1, 'status' => 'P'
    ];
    
    public function projectType()
    {
    	return $this->belongsTo(ProjectType::class);
    }

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function accountable()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
    
    public function currency()
    {
    	return $this->belongsTo(Currency::class, 'pay_curr_id');
    }

    public function mode()
    {
    	return $this->belongsTo(Mode::class, 'pay_mode_id');
    }

    public function type()
    {
    	return $this->belongsTo(Type::class, 'pay_type_id');
    }

    public function visit()
    {
    	return $this->belongsTo(Visit::class);
    }

    public function projects()
    {
    	return $this->hasMany(Project::class);
    }
    
    public function employees()
    {
    	return $this->hasMany(Employee::class);
    }

    public function independents()
    {
    	return $this->hasMany(Independent::class);
    }

    public function providers()
    {
    	return $this->hasMany(Provider::class);
    }

    public function sellers()
    {
    	return $this->hasMany(Seller::class);
    }
    
    public function getTotalHoursAttribute() {
        $hours = 0;
        foreach ($this->employees as $emp)
            $hours += $emp->num_hours;
        return $hours;
    }

    public function getTotalCostEmployeesAttribute() {
        $total = 0;
        foreach ($this->employees as $emp)
            $total += $emp->subtotal;
        return $total;
    }
    
    public function getTotalCostIndependentsAttribute() {
        $total = 0;
        foreach ($this->independents as $ind)
            $total += $ind->subtotal;
        return $total;
    }
        
    public function getTotalCostProvidersAttribute() {
        $total = 0;
        foreach ($this->providers as $pro)
            $total += $pro->subtotal;
        return $total;
    }

    public function getTotalCommissionAttribute() {
        $total = 0;
        foreach ($this->sellers as $sel)
            $total += $sel->user->commission;
        return $total;
    }

    public function getTotalCostAttribute() {
        return $this->totalCostEmployees + $this->totalCostIndependents + $this->totalCostProviders;
    }

    public function getTotalFinalAttribute() {
        return $this->totalCost * (1 - 0.01 * $this->perc_fit) * (1 + 0.01 * $this->totalCommission);
    }
}