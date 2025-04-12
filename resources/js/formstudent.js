document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('#student-table .open-student-modal').forEach(link => {

        link.addEventListener('click', function(event) {
            const url = link.getAttribute('data-route');

            fetch(url)
                .then(response => response.json())
                .then(user =>{
                    document.querySelector('#student-modal input[name="last_name"]').value = user.last_name;
                    document.querySelector('#student-modal input[name="first_name"]').value = user.first_name;
                    document.querySelector('#student-modal input[name="email"]').value = user.email;
                    document.querySelector('#student-modal input[name="birth_date"]').value = user.birth_date;
                    document.querySelector('#student-modal select[name="school_id"]').value = userschool.school_id;
                })
        });

    });
});
