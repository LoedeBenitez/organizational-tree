<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\SubDepartment;
use Livewire\Component;
use App\Models\Position as PositionModel;
use DB;
use Livewire\WithFileUploads;

class Position extends Component
{
    use WithFileUploads;

    public $positions = [];
    public $departments = [];

    public $subDepartments = [];
    public $newPosition, $basedOnPosition, $basedOnDepartment, $basedOnSubDepartment;
    public PositionModel $positionModel;
    public Department $department;
    public SubDepartment $subDepartment;
    public $department_longname;
    public $department_shortname;
    public $department_code;
    public $sub_department_longname;
    public $sub_department_shortname;
    public $sub_department_code;
    public $departmentChoice;

    public $file;
    public function render()
    {
        $this->getAllPosition();
        $this->getAllDepartments();
        $this->getAllSubDepartments();
        return view('livewire.position');
    }
    public function getAllPosition()
    {
        $list = PositionModel::all();
        $this->positions = $list;
    }

    public function addPosition()
    {

        $basedOnPosition = $this->basedOnPosition;
        $positionName = $this->newPosition;
        $level = 0;
        $sub_level = 0;
        $parent_id = null;
        $department = $this->basedOnDepartment;

        $subdepartment = $this->basedOnSubDepartment;
        DB::beginTransaction();
        $this->positionModel = new PositionModel();
        try {
            if ($basedOnPosition != null) {
                $parent = PositionModel::find($basedOnPosition);
                $parent_id = $parent->id;
                $level = ++$parent->level;
                $sub_level_count = PositionModel::where('level', $level)
                    ->where('parent_id', $parent_id)
                    ->get();
                $sub_level = count($sub_level_count);
            }

            $this->positionModel->position_name = $positionName;
            $this->positionModel->level = $level;
            $this->positionModel->sub_level = $sub_level;
            $this->positionModel->department_id = $department;
            $this->positionModel->sub_department_id = $subdepartment;
            $this->positionModel->parent_id = $parent_id;
            $this->positionModel->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function archivePosition()
    {
        if ($this->basedOnPosition != null) {
            try {
                DB::beginTransaction();
                $selectedPosition = PositionModel::find($this->basedOnPosition);
                $selectedPosition->status = 0;
                $selectedPosition->save();
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                dd($exception);
            }
        }
    }

    public function getAllDepartments()
    {
        $list = Department::all();
        $this->departments = $list;
    }
    public function addDepartment()
    {
        $rules = [
            'department_longname' => 'required',
            'department_shortname' => 'required',
            'department_code' => 'required',
        ];

        $fields = $this->validate($rules);
        $this->department = new Department();
        try {
            DB::beginTransaction();
            $this->department->fill($fields);
            $this->department->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }
    }

    public function getAllSubDepartments()
    {
        $list = SubDepartment::all();
        $this->subDepartments = $list;
    }
    public function addSubDepartment()
    {
        $rules = [
            'sub_department_longname' => 'required',
            'sub_department_shortname' => 'required',
            'sub_department_code' => 'required',
        ];

        $fields = $this->validate($rules);
        $this->subDepartment = new SubDepartment();
        try {
            DB::beginTransaction();
            $this->subDepartment->department_id = $this->departmentChoice;
            $this->subDepartment->sub_department_longname = $fields['sub_department_longname'];
            $this->subDepartment->sub_department_shortname = $fields['sub_department_shortname'];
            $this->subDepartment->sub_department_code = $fields['sub_department_code'];
            $this->subDepartment->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }
    }
}
