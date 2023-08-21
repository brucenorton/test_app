console.log('test_app.js');

let displaySection = document.querySelector('#display');
let insertSection = document.querySelector('#insert');

//fetch info from the db
function fetchUsers() {
   displaySection.innerHTML = '';

  fetch('app/select.php',{
    //body: userData,
    method: "post"
  })
  .then(
    function(response) {
      if (response.status !== 200) {
        console.log('uhoh, we got problems: ' + response.status);
        return;
      }

      // Examine the text in the response
      response.json()
      .then(function (data) {
        console.log(data);
        displayUsers(data);
      });
    }
  )
  .catch(function(err) {
    console.log('fetch error', err);
  });

}
//actually need to call the function!!
fetchUsers();

/* display users is called from the fetchUsers() function, passing the data as a parameter */



function displayUsers(data) {
  let ul = document.createElement('ul');
  data.forEach(function (user) {
    console.log(user);
    let li = document.createElement('li');
    li.innerHTML = `${user.full_name} likes the colour ${user.favourite_colour}`;
    ul.append(li);
  
  })

  displaySection.append(ul);
}

/* now let's insert a user */

let insertForm = document.querySelector('#insert form');
const submitButton = document.querySelector('#insert form a');
submitButton.addEventListener('click', insertUser);

function insertUser(event) {
  event.preventDefault();
  submitButton.removeEventListener('click', insertUser);
  
  //add check to see if localStorage variables exist?
  let formData = new FormData(insertForm);

  fetch('app/insert.php',{
    body: formData,
    method: "post"
  })
  .then(
    function(response) {
      if (response.status !== 200) {
        console.log('uhoh, we got signupUser problems: ' +
          response.status);
        return;
      }

      // Examine the text in the response
      response.json().then(function(data) {
        console.log(data);
        fetchUsers();
      });
    }
  )
  .catch(function(err) {
    console.log('fetch error', err);
  });
}