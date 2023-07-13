<div>
    <div wire:loading.remove>
        <button class="btn btn-primary" wire:click="test">
            <i class="fa fa-vial"></i> Test
        </button>
    </div>
    <div wire:loading>
        <button class="btn btn-primary" disabled>
            <i class="fa fa-spinner fa-spin"></i> Test
        </button>
    </div>
</div>
