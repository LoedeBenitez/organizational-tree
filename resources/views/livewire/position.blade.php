<div>
    <select name="" id="" wire:model="basedOnPosition">
        <option value="" selected disabled>-- Select a Position --</option>
        @forelse ($positions as $item)
            <option value="{{ $item['id'] }}">{{ $item['position_name'] }}</option>
        @empty
            <option selected disabled>--There are no positions open--</option>
        @endforelse
    </select>
    <br>
    <p>Available Departments</p>
    <select name="" id="" wire:model="basedOnDepartment">
        <option value="" selected disabled>-- Select a department --</option>
        @forelse ($departments as $item)
            <option value="{{ $item['id'] }}">{{ $item['department_longname'] }}</option>
        @empty
            <option value="" selected disabled>-- There are no departments open --</option>
        @endforelse
    </select>
    <br>
    <p>Available Sub Departments</p>
    <select name="" id="" wire:model="basedOnSubDepartment">
        <option selected>-- Select a sub department --</option>
        @forelse ($subDepartments as $item)
            <option value="{{ $item['id'] }}">{{ $item['sub_department_longname'] }}</option>
        @empty
            <option value="" selected disabled>-- There are no sub departments open --</option>
        @endforelse
    </select>
    <form action="" wire:submit.prevent="addPosition">
        <input type="text" wire:model="newPosition">
        <button>add position</button>
    </form>
    <button wire:click="archivePosition">Delete</button>


    <div>

        @forelse($positions as $item)
            <p>{{ $item->position_name }} <span>{{ $item->children }}</span></p>
        @empty
            <p>No record found</p>
        @endforelse

    </div>

    <br>
    <p>Department</p>
    <div>
        <div>
            <form action="" wire:submit.prevent="addDepartment">
                <input type="text" wire:model="department_longname" placeholder="Department Long Name">
                <input type="text" wire:model="department_shortname" placeholder="Department Short Name">
                <input type="text" wire:model="department_code" placeholder="Department Code">
                <button>add department</button>
            </form>
        </div>
    </div>

    <br>
    <p>Sub Department</p>

    <div>
        <div>
            <form action="" wire:submit.prevent="addSubDepartment">
                <select name="" id="" wire:model="departmentChoice">
                    <option value="" selected disabled>-- Select a department --</option>
                    @forelse ($departments as $item)
                        <option value="{{ $item['id'] }}">{{ $item['department_longname'] }}</option>
                    @empty
                        <option value="" selected disabled>-- There are no departments open --</option>
                    @endforelse
                </select>
                <input type="text" wire:model="sub_department_longname" placeholder="Sub Department Long Name">
                <input type="text" wire:model="sub_department_shortname" placeholder="Sub Department Short Name">
                <input type="text" wire:model="sub_department_code" placeholder="Sub Department Code">

                <button>add department</button>
            </form>
        </div>
    </div>
</div>
