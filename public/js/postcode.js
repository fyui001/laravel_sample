const createAndInsertElement = (baseId, addId, addTag) => {
    const base = document.getElementById(baseId);
    const add = document.createElement(addTag);
    add.setAttribute("id", addId);
    base.parentNode.insertBefore(add, base);

    return document.getElementById(addId);
}

const removeAddress = () => {
    writeAddress("", "", "");
}

const removeShowErrorP = () => {
    const showErrorElement = document.getElementById("error");

    if (showErrorElement) {
        showErrorElement.remove();
    }
}

const removeAddressSelect = () => {
    const addressSelectElement = document.getElementById("address_select");

    if (addressSelectElement) {
        addressSelectElement.remove();
    }
}

const remove = () => {
    removeShowErrorP();
    removeAddressSelect();
    removeAddress();
}

const writeAddress = (prefecture, city, town) => {
    document.getElementById("prefecture").value = prefecture;
    document.getElementById("city").value = city;
    document.getElementById("town_1").value = town === "以下に掲載がない場合" ? "" : town;
}

const showError = (error) => {
    remove();

    const p = createAndInsertElement("prefecture_title", "error", "p");
    p.setAttribute("class", "alert alert-danger");
    p.setAttribute("role", "alert");
    p.setAttribute("style", "margin-top: 10px; margin-bottom: 10px;");
    p.innerHTML = error;
}

const addressSelect = (addressObjArray) => {
    remove();

    const select = createAndInsertElement("prefecture_title", "address_select", "select");
    select.setAttribute("class", "custom-select");
    select.setAttribute("style", "margin-top: 10px; magine-bottom: 10px;");

    for (const addressObj of addressObjArray) {
        const prefecture = addressObj.prefecture_kanji;
        const city = addressObj.city_kanji;
        const town = addressObj.town_kanji === "以下に掲載がない場合" ? "" : addressObj.town_kanji;

        const addressObjString = JSON.stringify({
            prefecture: prefecture,
            city: city,
            town: town
        });

        const specSelect = document.createElement("option");
        specSelect.appendChild(document.createTextNode(`${prefecture}${city}${town}`))
        specSelect.setAttribute("value", addressObjString);
        specSelect.setAttribute("onclick", "addressSelectComplete();");
        select.appendChild(specSelect);
    }
}

const addressSelectComplete = () => {
    const addressSelectElement = document.getElementById('address_select');
    const addressObj = JSON.parse(addressSelectElement.options[addressSelectElement.selectedIndex].value);
    writeAddress(addressObj.prefecture, addressObj.city, addressObj.town);
}

const complete = async () => {
    try {
        const body = {
            post_code: document.getElementById("postal_code").value
        };

        console.log(body);

        const _response = await fetch("post_code/search", {
            method: "POST",
            headers: {
                "Content-Type": "application/json;charset=utf-8",
                'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content,
            },
            mode: "same-origin",
            body: JSON.stringify(body)

        });

        if (!_response.ok) throw new Error("Failed to connect to the server.");

        const response = await _response.json();

        console.log(response);

        /*
        {
            "validation": boolean,
            "does_database_connect": boolean,
            "does_postal_code_exist": boolean,
            "postal_code": string,
            "address": []
        }
        */

        if (!response.status) throw new Error("Invalid value");
        /*if (!response.does_database_connect) throw new Error("Failed to connect to the database.");
        if (!response.does_postal_code_exist) throw new Error("The postal code does not exist.");*/

        if (response.addressData.length === 1) {
            remove();

            const addressObj = response.addressData[0];
            writeAddress(addressObj.prefecture, addressObj.city, addressObj.town);
        } else {
            addressSelect(response.address);
        }
    } catch (error) {
        showError(error);
    }
}
