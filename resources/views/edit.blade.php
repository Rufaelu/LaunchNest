<div id="edit" style="height: 100vh">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="py-12">{{--this part is the profile pic section for updating the user profile pic.--}}
        @include('Profile-card')
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-4">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #edit::-webkit-scrollbar{
        display: none;
    }
</style>


