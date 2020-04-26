
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <div class="row">
            @if($type === "edit")
                <div class="col">
                    <button type="submit" {{ $disabled??'' }} class="btn btn-success m-btn m-btn--pill m-btn--air pull-right m-btn--custom m-btn--icon">
                        <span><i class="la la-edit"></i><span>Update {{ $name }}</span></span></button>
                </div>
            @elseif($type === "create")
                <div class="col">
                    <button class="btn btn-outline-light m-btn--pill pull-left m-btn--custom text-dark"
                            type="reset">Reset Form
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-success m-btn m-btn--pill m-btn--air pull-right m-btn--custom m-btn--icon"
                        type="submit" {{ $disabled??'' }}>
                        <span><i class="la la-check"></i><span>Add {{ $name }}</span></span></button>
                </div>
            @elseif($type === "show")
                <div class="col">
                    <button type="button" class="btn btn-outline-light m-btn--pill pull-left m-btn--custom text-danger btn-delete"  data-id="{{ $id }}" data-url="{{ $delete_url }}">Remove</button>
                </div>
                <div class="col">
                    <a href="{{ $edit_url }}" class="btn btn-primary m-btn m-btn--pill m-btn--air pull-right m-btn--custom m-btn--icon"><span><i class="la la-edit"></i><span>Edit Details</span></span></a>
                </div>
            @endif
        </div>
    </div>
</div>
