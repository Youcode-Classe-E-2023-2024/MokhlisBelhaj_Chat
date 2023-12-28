let URLROOT = 'http://localhost/MokhlisBelhaj_chat/'

// get user

$(document).ready(function () {
    // Function to fetch user data using Ajax
    function fetchUserData() {
        $.ajax({
            url: URLROOT + 'Users/getUser', 
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
 
    function fetchRoomData() {
        $.ajax({
            url: URLROOT + 'Rooms/getRoom',
            method: 'post',
            dataType: 'json',
            success: async function (data) {
                console.log(data);
    
                if (data && data.length > 0) {
                    $('#controom').html(data.length);
                    displayRoomData(data);
    
                    let roms = document.querySelectorAll(".roms");
                    let chat = document.getElementById("chat");
    
                    roms.forEach(rom => {
                        rom.addEventListener("click", () => {
                            let roomId = rom.getElementsByClassName("id")[0].value;
    
                            // Make an AJAX POST request to fetch messages for the room
                            $.ajax({
                                url: 'http://localhost/MokhlisBelhaj_chat/message/messageRoom',
                                type: 'POST',
                                data: { roomId: roomId },
                                success: function (response) {
                                    let test = JSON.parse(response);
                                    console.log(test);
    
                                    // Handle the success response here
    
                                    chat.innerHTML = "";
                                    test.message.forEach(ele => {
                                        console.log(ele);
    
                                        // Assuming 'user' is the current user's ID
                                        var currentUserID = test.user;
    
                                        if (ele.from_user === currentUserID) {
                                            chat.innerHTML += `
                                                <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                                    <div class="flex items-center justify-start flex-row-reverse">
                                                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                            ${ele.name.charAt(0)}
                                                        </div>
                                                        <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                            <div>${ele.content}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                        } else {
                                            chat.innerHTML += `
                                                <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                                    <div class="flex flex-row items-center">
                                                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                            ${ele.name.charAt(0)}
                                                        </div>
                                                        <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                            <div>${ele.content}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                        }
                                    });
    
                                    // Message sending logic
                                    $(document).ready(function () {
                                        $('#messageForm').submit(function (event) {
                                            event.preventDefault();
    
                                            // Get the message input value
                                            var messageInput = $('[name="messageInput"]').val();
    
                                            // AJAX request to send the message along with idroom
                                            $.ajax({
                                                url: 'http://localhost/MokhlisBelhaj_chat/message/sendMessage',
                                                type: 'POST',
                                                data: { message: messageInput, idroom: roomId },
                                                success: function (response) {
                                                    console.log('Message sent successfully:', response);
                                                    // Add your logic for handling a successful response
                                                },
                                                error: function (error) {
                                                    console.error('Error sending message:', error);
                                                    // Add your logic for handling errors
                                                }
                                            });
                                        });
    
                                        // Alternatively, you can bind the click event to the button
                                        $('#sendMessageButton').click(function () {
                                            $('#messageForm').submit();
                                        });
                                    });
                                },
                                error: function (error) {
                                    // Handle errors here
                                    console.error('Error:', error);
                                }
                            });
                        });
                    });
                } else {
                    // Handle empty response or error
                    $('#users').html('No room data available.');
                }
            },
            error: function () {
                // Handle Ajax error
                $('#users').html('Error fetching room data.');
            }
        });
    }
    // Function to display user data on the page
    function displayRoomData(RoomData) {
        var html = '';

        $.each(RoomData, function (index, Room) {
            html += `<button  class="roms flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
            <div class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full">
            ${Room.name.charAt(0)}
            </div>
            <div class="ml-2 text-sm font-semibold">
            <input class="id" type="hidden" value="${Room.idroom}">
            ${Room.name}
            </div>
        </button>`
        });
        html += '</ul>';

        $('#Room').html(html);
    }
    // Function to display user data on the page
    function displayUserData(userData) {
        var html = '';

        $.each(userData, function (index, user) {
            html += `<button class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
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
    function fetchDataEverySecond() {
        function run() {
            fetchUserData();
            fetchRoomData();
        }

        setInterval(run, 1000); // Pass the reference to the function without invoking it
    }
    fetchDataEverySecond();




});


// add room 
// $(document).ready(function () {
//     $('#submitBtn').on('click', function () {
//         event.preventDefault();

//         // Collect form data
//         var formData = {
//             name: $('#name').val(),
//             selectedUsers: $('input[name="selected_users[]"]:checked').map(function () {
//                 return this.value;
//             }).get()
//         };
//         console.log(formData);

//         // Send the data using AJAX
//         $.ajax({
//             type: 'POST',
//             url: URLROOT+'Rooms /newRoom', // Replace with your server-side script URL
//             data: formData,
//             success: function (response) {
//                 // Handle the success response
//                 console.log(response);
//             },
//             error: function (error) {
//                 // Handle the error
//                 console.error(error);
//             }
//         });
//     });
// });
$(document).ready(function () {
    $('#submitBtn').on('click', function (event) {
        event.preventDefault();

        // Collect form data
        var formData = {
            name: $('#name').val(),
            selectedUsers: $('input[name="selected_users[]"]:checked').map(function () {
                return this.value;
            }).get()
        };

        // Uncheck all checkboxes
        $('input[name="selected_users[]"]').prop('checked', false);

        // Clear input field value
        $('#name').val('');

        console.log(formData);

        // Send the data using AJAX
        $.ajax({
            type: 'POST',
            url: URLROOT + 'Rooms/newRoom', 
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



