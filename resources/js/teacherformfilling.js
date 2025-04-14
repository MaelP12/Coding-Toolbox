document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('#teacher-table .open-teacher-modal').forEach(link => {

        link.addEventListener('click', function(event) {
            const url = link.getAttribute('data-route');

            fetch(url)
                .then(response => response.json())
                .then(user =>{
                    console.log(user);
                    document.querySelector('#teacher-modal input[name="last_name"]').value = user.last_name;
                    document.querySelector('#teacher-modal input[name="first_name"]').value = user.first_name;
                    document.querySelector('#teacher-modal input[name="email"]').value = user.email;
                    document.querySelector('#teacher-modal select[name="school_id"]').value = user.school_id;
                })
        });

    });
});
