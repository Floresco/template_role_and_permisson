<x-layouts.layout :title="$title">
    <x-slot:head_btn>
        <x-layouts.partials.head-button
            text="{{trans('messages.new')}}"
            :url="route('user_management.users.create')"
            color="primary"
            :gateway="[\App\Utils\Utils::namePerm(\App\Enums\Permissions::Create, \App\Enums\Models::USER)]"
        />
    </x-slot:head_btn>
    <x-slot:js>
        <script>
            function confirm_delete(url_submit, data_array) {

                const data_json = JSON.parse(data_array.replaceAll('###', '"'));
                if (confirm('Voulez-vous supprimer l\'utilisateur ' + data_json.name + ' , adresse mail:  ' + data_json.email + ' ?')) {
                    handleBlockUI()
                    $.ajax({
                        url: url_submit,
                        type: "DELETE",
                        data: data_json.data,
                        success: function (data) {
                            console.log(data)
                            handleUnblockModal()
                            document.location.href = location.href;
                        },
                        error: function (data) {
                            console.log(data)
                            handleUnblockUI()
                        }
                    });
                }
                console.log('eEnd')
                return;

            }
        </script>
    </x-slot:js>
    <div class="card">
        <div class="card-body">
            <x-user-management.users.table :users="$users"/>
        </div>
    </div>
</x-layouts.layout>
