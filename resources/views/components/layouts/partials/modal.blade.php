<div class="modal fade bs-example-modal-lg" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="btn-close"></button>
            </div>

            <div class="modal-body" id="myLargeModalContent">
                ...
            </div>

            <input type="hidden" value="0" name="type_operation" id="type_operation" />
            <input type="hidden" value="0" name="id_member" id="id_member" />

            <div class="modal-footer d-flex justify-content-center" id="submit_mod">
                <button type="button" class="btn btn-sm btn-danger " data-bs-dismiss="modal" id="cancelRav"><i class="fa fa-ban"></i>
                    {{trans('messages.cancel')}}</button>
                <button type="button" class="btn btn-sm btn-success antosubmit" onclick="do_operation()" id="submitRav"><i class="fa fa-check"></i> {{trans('messages.submitbutton')}}</button>
            </div>
        </div>

    </div>
</div>

