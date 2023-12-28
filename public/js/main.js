let URLROOT= 'http://localhost/MokhlisBelhaj_chat/'

// get user

$(document).ready(function () {
    // Function to fetch user data using Ajax
    function fetchUserData() {
        $.ajax({
            url: URLROOT+'Users/getUser', // Adjust the URL accordingly
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // Handle the retrieved data
                if (data && data.length > 0) {
                    $('#cont').html(data.length);
                    // Assuming the data is an array of user objects
                    
                    displayUserData(data);
                } else {
                    // Handle empty response or error
                    $('#users').html('No user data available.');
                }
            },
            error: function () {
                // Handle Ajax error
                $('#users').html('Error fetching user data.');
            }
        });
    }

    // Function to display user data on the page
    function displayUserData(userData) {
        var html ='';
       
        $.each(userData, function (index, user) {
            html +=  `<button class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
            <div class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full">
            ${user.name.charAt(0)}
            </div>
            <div class="ml-2 text-sm font-semibold">
                <span class='text-black'>
                    ${user.name}
                </span>
            </div>
        </button>`
        });
        html += '</ul>';

        $('#users').html(html);
    }
    function fetchUserDataEverySecond() {
        fetchUserData(); // Fetch data immediately
        setInterval(fetchUserData, 1000); // Fetch data every 1000 milliseconds (1 second)
    }
    fetchUserDataEverySecond()
 
   
    
});

// add room 
$(document).ready(function () {
    $('#submitBtn').on('click', function () {
        event.preventDefault();

        // Collect form data
        var formData = {
            name: $('#name').val(),
            selectedUsers: $('input[name="selected_users[]"]:checked').map(function () {
                return this.value;
            }).get()
        };
        console.log(formData);

        // Send the data using AJAX
        $.ajax({
            type: 'POST',
            url: URLROOT+'Rooms /newRoom', // Replace with your server-side script URL
            data: formData,
            success: function (response) {
                // Handle the success response
                console.log(response);
            },
            error: function (error) {
                // Handle the error
                console.error(error);
            }
        });
    });
});


  