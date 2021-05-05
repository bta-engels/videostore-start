<div class="d-inline">
    <x-form :action="route('movies')" class="row">
        <x-form-select class="col-auto" name="selectedAuthor" :options="$options" :default="$author" />
        <x-form-submit class="col-auto btn btn-sm btn-primary p-2 ml-1 h-100">
            <span>OK</span>
        </x-form-submit>
    </x-form>
</div>