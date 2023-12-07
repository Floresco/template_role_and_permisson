@php
    $permissions = \App\Models\Permission::query()->select(['id', 'name','description'])->get()->toArray();

@endphp
<x-layouts.layout :title="$title">
    <x-slot:head_btn>
        <x-layouts.partials.head-button
            text="New Item"
            url="google.tg"
            icon="fas fa-minus"
            color="danger"
            idm="defaultModalPrimary"
            :modal="true"
        />
    </x-slot:head_btn>
    <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Default modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes,
                        user
                        notifications, or completely custom content.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</x-layouts.layout>
