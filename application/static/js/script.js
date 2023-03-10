let suggestions = [
    "Barber",
    "Colourist",
    "Cosmetologist",
    "Esthetician",
    "Eyelash tech",
    "Hairdresser",
    "Hairstylist",
    "Laser Hair removal tech",
    "Makeup Artist",
    "Massage therapist",
    "Nail tech",
    "Piercer",
    "Tattoo Artist",
];

// Get references to all required elements
const searchWrapper = document.querySelector(".search-input-one");
const inputBox = searchWrapper.querySelector(".input-one");
const suggBox = searchWrapper.querySelector(".autocom-box-one");
const icon = searchWrapper.querySelector(".icon-one");
let linkTag = searchWrapper.querySelector(".a-one");
let webLink;

// If user press any key and release
inputBox.onkeyup = (e) => {
    console.log(1);
    console.log(e);
    // User entered data
    let userData = e.target.value;
    let emptyArray = [];
    if (userData) {
        icon.onclick = () => {
            linkTag.click();
            console.log(linkTag.click());
        };
        emptyArray = suggestions.filter((data) => {
            // Filter array value and user characters to lowercase and return only those words which are start with user entered chars

            return data
                .toLocaleLowerCase()
                .startsWith(userData.toLocaleLowerCase());
        });

        let array = emptyArray.slice(0, 4);

        array = array.map((data) => {
            // Pass return data inside <li> tags

            return (data = "<li>" + data + "</li>");
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        showSuggestions(array);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            // Add onclick attribute to all <li> tags
            allList[i].setAttribute("onclick", "select(this)");
        }
    } else {
        // Hide autocomplete box
        searchWrapper.classList.remove("active");
    }
};

function select(element) {
    console.log(element);
    let selectData = element.textContent;
    inputBox.value = selectData;
    icon.onclick = () => {};
    searchWrapper.classList.remove("active");
}

function showSuggestions(list) {
    let listData;
    if (list.length) {
    }
    if (!list.length) {
        console.log(list.length);
        userValue = inputBox.value;
        listData = "<li>" + userValue + "</li>";
    } else {
        listData = list.join("");
    }

    suggBox.innerHTML = listData;
}
