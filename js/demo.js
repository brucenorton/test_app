//code from demo_db

//fetch the data, just like for our APIs.
  async function fetchFavourites(url){
    const response = await fetch(url);
    const data = await response.json();
    displayData(data);
  }

  //call fetchFavourites function on load
  fetchFavourites('app/select.php');

  function displayData(data){
    //select element from HTML where we'll put our tv show
    const display = document.querySelector('#display');
    display.innerHTML = '';

    //create an unordered list
    let ul = document.createElement('ul');
    
    data.forEach((user)=>{
      //console.log(user);
      //create items, add text and append to the list
      let li = document.createElement('li');
      li.innerHTML = `${user.name} likes to watch ${user.tvshow}.`;
      ul.appendChild(li);
    })
    //don't forget to append your elements.
    display.appendChild(ul);
  }

//this is * new * passing data to insert!!

const submitButton = document.querySelector('#submit');
submitButton.addEventListener('click', getFormData);

function getFormData(event){
  event.preventDefault();
  console.log('submit clicked');

  //get the form data & call an async function
  const insertFormData = new FormData(document.querySelector("#insert-form"));
  let url = "app/insert_v3.php";
  inserter(insertFormData, url);

}

async function inserter(data, url){
  const response = await fetch(url, {
    method: "POST",
    body: data
  });
  const confirmation = await response.json();
  console.log(confirmation);


}