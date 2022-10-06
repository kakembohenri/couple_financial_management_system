<!DOCTYPE html>
<html lang="en">
@extends('layout.header_nav_admin')
<body>
    @if(!empty(session('status')))
    <div class='popup' id='popup'>
        <div class='popup-container'>
            <p>{{ session('status') }}</p>
        </div>
    </div>
    @endif
    <div class='backdrop'></div>
        <form class='form form-invite' id='form-del' action="{{ route('admin.manage') }}" method='post'>
            @csrf
            <h4>Are you sure you wanna delete this user?</h4>
            <input type="hidden" name='id' id='item_id' />
            <div>
                <button type='button' class='btn btn-del'>Cancel</button>
                <button type='submit' class='btn btn-invite'>Delete</button>
            </div>
        </form>
    <div class='admin-main-container'>
        @extends('layout.navbar_admin')
        <div class='admin-dashboard'>
            <h3>Manage users</h3>
            <div class="table-container">
                <div class="table-row table-head">
                    <div class="table-cell">
                        <p>Username</p>
                    </div>
                    <div class="table-cell">
                        <p>first name</p>
                    </div>
                    <div class="table-cell">
                        <p>Last name</p>
                    </div>
                    <div class="table-cell">
                        <p>Gender</p>
                    </div>
                    <div class="table-cell">
                        <p>Email</p>
                    </div>
                    <div class="table-cell">
                        <p>Phone number</p>
                    </div>
                </div>
                @forelse($users as $user)
                <div class="table-row">
                    <div class="table-cell">
                        <p>{{ $user->username }}</p>
                    </div>
                    <div class="table-cell">
                        <p>{{ $user->f_name}}</p>
                    </div>
                    <div class="table-cell">
                        <p>{{ $user->l_name }}</p>
                    </div>
                    <div class="table-cell">
                        <p>{{ $user->gender }}</p>
                    </div>
                    <div class="table-cell">
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="table-cell">
                        <p>{{ $user->tel_no }}</p>
                    </div>
                </div>
                <form>
                    @csrf
                    <button type='button' class='btn' value="{{ $user->id }}" id='del'>Delete</button>
                </form>
                @empty
                <p>No users</p>
                @endforelse
            </div>
            
        </div>
    </div>
    <script>
        let del = document.querySelectorAll('#del')
        let backdrop = document.querySelector('.backdrop')
        let form_del = document.querySelector('#form-del')
        let del_button = document.querySelector('button[type="submit"]')
        let item_id = document.querySelector('#item_id')
        // let submit = document.querySelector('button[type="submit"]')

        del.forEach(element => {
            element.addEventListener('click', getAlert)

            function getAlert(e) {
                backdrop.style.display = 'flex'
                form_del.style.display = 'flex'
                item_id.value = e.target.value

                console.log(item_id.value)
            }

            // id.addEventListener('click', get)

            // function get(e){
            //     console.log(e.target.value)
            // }

            backdrop.addEventListener('click', close)

            function close(){
                form_del.style.display = 'none'
                backdrop.style.display = 'none'
            } 
        });
    </script>
    <script>
        let submit = document.querySelector("button[type='submit']")
 
         let pop = document.querySelector('#popup')
 
         submit.addEventListener('click', prevent)
 
             function prevent(e){
                 e.preventDeafault()
             }
 
         if(pop !== null){
 
             setTimeout(() => {
              pop.className = 'popup-close'
             }, 9000);
         }
     </script>
</body>
</html>