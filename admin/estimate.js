let lengthOfRoom, widthOfRoom, heightOfRoom;
let blockLength, blockWidth, blockHeight;
let numberOfDoorsPerRoom, numberOfWindowsPerRoom;
let lengthOfDoor, heightOfDoor;
let lengthOfWindow, heightOfWindow;

let lengthOfTile, widthOfTile;
let numOfRooms;

let a, b, c, d, e, f, g, h, i;
let lengthOfSheet, widthOfSheet;
//Getting container divs
let blocksContainer = document.querySelector('.num-of-blocks');
let tilesContainer = document.querySelector('.num-of-tiles');
let roofContainer = document.querySelector('.roof-content');

//Getting the inputs neccessary for calculating number of blocks;
let lengthOfRoomInput = document.querySelector('.l-of-room');
let widthOfRoomInput = document.querySelector('.w-of-room');
let heightOfRoomInput = document.querySelector('.h-of-room');
let lengthOfDoorInput = document.querySelector('.l-of-door');
let heightOfDoorInput = document.querySelector('.h-of-door');
let lengthOfWindowInput = document.querySelector('.l-of-window');
let heightOfWindowInput = document.querySelector('.h-of-window');
let numberOfDoorsInput = document.querySelector('.num-of-doors');
let numberOfWindowsInput = document.querySelector('.num-of-windows');
let blockLengthInput = document.querySelector('.block-length');
let blockHeightInput = document.querySelector('.block-height');
let numberOfRoomsInput = document.querySelector('.num-of-rooms');
let calculateBlocksButton = document.querySelector('#calculate-blocks');
let result = document.querySelector('#result');

//Getting the inputs necessary for calculating number of tiles
let tLengthOfRoom = document.querySelector('.tl-of-room')
let tWidthOfRoom = document.querySelector('.tw-of-room')
let tLengthOfTile = document.querySelector('.tl-of-tile')
let tWidthOfTile = document.querySelector('.tw-of-tile')
let tNumOfRooms = document.querySelector('.tnum-of-rooms')
let calculateTilesButton = document.querySelector('#calculate-tiles')
let tileResult = document.querySelector('#tile-result');

//Getting svg divs
let roof1 = document.getElementById('roof1');
let roof2 = document.getElementById('roof2');

//Getting Roof Sheet inputs
let aOfT1 = document.getElementById('l-of-t1');
let bOfT1 = document.getElementById('b-of-t1');
let cOfT1 = document.getElementById('h-of-t1');

let aOfT2 = document.getElementById('l-of-t2');
let bOfT2 = document.getElementById('b-of-t2');
let cOfT2 = document.getElementById('h-of-t2');

let aOfTr = document.getElementById('l-of-tr1');
let bOfTr = document.getElementById('b-of-tr1');
let cOfTr = document.getElementById('h-of-tr1');

let lenOfSheet = document.getElementById('l-of-sheet');
let widOfSheet = document.getElementById('w-of-sheet');

let calculateSheetsButton = document.getElementById('calculate-sheets');
let resultOfSheets = document.getElementById('result-of-sheet');



function calculateBlocks(numberOfRooms) {
    let roomSurfaceArea = 2 * (lengthOfRoom * heightOfRoom + widthOfRoom * heightOfRoom);
    let doorSurfaceArea = lengthOfDoor * heightOfDoor;
    let windowSurfaceArea = lengthOfWindow * heightOfWindow;
    let allBlocksSurfaceArea = roomSurfaceArea - (doorSurfaceArea * numberOfDoorsPerRoom) - (windowSurfaceArea - numberOfWindowsPerRoom);
    let blockSurfaceArea = blockLength * blockHeight;
    let numberOfBlocks = allBlocksSurfaceArea / blockSurfaceArea;

    let marginOfErrorPercent = 20

    let finalNumberOfBlocks = numberOfBlocks * (100 + marginOfErrorPercent) / 100;
    return Math.ceil(finalNumberOfBlocks * numberOfRooms)
}

//Button click function that will show the number of blocks;
calculateBlocksButton.addEventListener('click', (e) => {
    e.preventDefault();
    lengthOfRoom = parseFloat(lengthOfRoomInput.value);
    widthOfRoom = parseFloat(widthOfRoomInput.value);
    heightOfRoom = parseFloat(heightOfRoomInput.value);
    lengthOfDoor = parseFloat(lengthOfDoorInput.value);
    heightOfDoor = parseFloat(heightOfDoorInput.value);
    lengthOfWindow = parseFloat(lengthOfWindowInput.value);
    heightOfWindow = parseFloat(heightOfWindowInput.value);
    numberOfDoorsPerRoom = Number(numberOfDoorsInput.value);
    numberOfWindowsPerRoom = Number(numberOfWindowsInput.value);
    blockLength = parseFloat(blockLengthInput.value);
    blockHeight = parseFloat(blockHeightInput.value);
    numOfRooms = parseInt(numberOfRoomsInput.value);


    const values = [
        lengthOfRoomInput.value,
        widthOfRoomInput.value,
        heightOfRoomInput.value,
        lengthOfDoorInput.value,
        heightOfDoorInput.value,
        lengthOfWindowInput.value,
        heightOfWindowInput.value,
        numberOfDoorsInput.value,
        numberOfWindowsInput.value,
        blockLengthInput.value,
        blockHeightInput.value,
        numberOfRoomsInput.value
    ];

    let emptyField;
    let invalidField;

    values.map(value => {
        if (value == "") {
            emptyField = true;
        }

        if (value <= 0) {
            invalidField = true;
        }
    });

    if (emptyField) {
        blocksContainer.style.border = "2px solid red";
        alert("Please Fill All Fields");
        return;
    }

    if (invalidField) {
        blocksContainer.style.border = "1px solid red";
        alert("Values less than or equal to zero are not allowed");
        return;
    }

    if (numberOfDoorsPerRoom % 1 !== 0) {
        blocksContainer.style.border = "1px solid red";
        alert("Number of Doors per room should be a whole number");
        return;
    }

    if (numberOfWindowsPerRoom % 1 !== 0) {
        blocksContainer.style.border = "1px solid red";
        alert("Number of Windows per room should be a whole number");
        return;
    }

    blocksContainer.style.border = "1px solid rgb(189, 189, 189)";
    let ans = calculateBlocks(numOfRooms);
    result.innerHTML = `${ans} blocks `;
})

function calculateTiles(numberOfRooms) {
    let floorSurfaceArea = lengthOfRoom * widthOfRoom
    let tileArea = lengthOfTile * widthOfTile

    let numberOfTiles = floorSurfaceArea / tileArea
    
    let marginOfErrorPercent = 20

    let finalNumberOfTIles = numberOfTiles * (100 + marginOfErrorPercent) / 100
    return Math.ceil(finalNumberOfTIles * numberOfRooms);
}

calculateTilesButton.addEventListener('click', (e) => {
    e.preventDefault();
    lengthOfRoom = parseFloat(tLengthOfRoom.value);
    widthOfRoom = parseFloat(tWidthOfRoom.value);
    lengthOfTile = parseFloat(tLengthOfTile.value);
    widthOfTile = parseFloat(tWidthOfTile.value);
    numOfRooms = parseInt(tNumOfRooms.value);


    values = [
        tLengthOfRoom.value,
        tWidthOfRoom.value,
        tLengthOfTile.value,
        tWidthOfTile.value,
        tNumOfRooms.value
    ]

    let emptyField;
    let invalidField;

    values.map(value => {
        if (value == "") {
            emptyField = true;
        }

        if (value <= 0) {
            invalidField = true;
        }
    });

    if (emptyField) {
        tilesContainer.style.border = "2px solid red";
        alert("Please Fill All Fields");
        return;
    }

    if (invalidField) {
        tilesContainer.style.border = "2px solid red";
        alert("Values less than or equal to zero are not allowed");
        return;
    }

    if (numOfRooms % 1 !== 0) {
        tilesContainer.style.border = "2px solid red";
        alert("Number of Doors per room should be a whole number");
        return;
    }
    
    blocksContainer.style.border = "2px solid rgb(189, 189, 189)";
    tileResult.innerHTML = `${calculateTiles(numOfRooms)} tiles are required`;
})

function calculateRoofingSheet() {
    let one = areaOfTriangle(c,c,e);
    let two = areaOfTriangle(b,b,g);
    let three = areaOfTrapezium(a, (d*2) + e, f);
    let four = areaOfTrapezium(i, h, c);

    let area = one + two * 2 + three * 2 + four * 2;

    let sheetArea = lengthOfSheet * widthOfSheet;

    let numberOfSheet = area / sheetArea;
    
    let marginOfErrorPercent = 20;

    let finalNumberOfSheet = numberOfSheet * (100 + marginOfErrorPercent) / 100;
    return Math.ceil(finalNumberOfSheet);
}

// console.log(areaOfTriangle(12,12,12))

function areaOfTriangle(a,b,c) {
    let temp = (a + b + c) / 2

    let area = Math.sqrt(temp*(temp - a)*(temp - b)*(temp-c))

    return area
}

function areaOfTrapezium(a,b,h) {
    let area = h * (a + b) / 2

    return area
}

let roofOneDiv = document.querySelector(".roof1");
let roofTwoDiv = document.querySelector(".roof2");
let firstIndicator = document.querySelectorAll('.indicator1');
let secondIndicator = document.querySelectorAll('.indicator2');

roofOneDiv.style.display = 'none';

for (let i = 0; i < firstIndicator.length; i++) {
    firstIndicator[i].style.display = 'none';
}

for (let i = 0; i < secondIndicator.length; i++) {
    secondIndicator[i].style.display = 'none';
}

roof1.addEventListener('click', () => {
    roofOneDiv.style.display = 'initial';
    roof1.style.boxShadow = "0px 0px 5px 2px black";
    roof2.style.boxShadow = '0px 0px 7px 2px rgb(206, 206, 206)';
 
    for (let i = 0; i < firstIndicator.length; i++) {
        firstIndicator[i].style.display = 'initial';
    }

    for (let i = 0; i < secondIndicator.length; i++) {
        secondIndicator[i].style.display = 'none';
    }
});

roof2.addEventListener('click', () => {
    roofOneDiv.style.display = 'initial';
    roof1.style.boxShadow = '0px 0px 7px 2px rgb(206, 206, 206)';
    roof2.style.boxShadow = "0px 0px 5px 2px black";

    for (let i = 0; i < secondIndicator.length; i++) {
        secondIndicator[i].style.display = 'initial';
    }

    for (let i = 0; i < firstIndicator.length; i++) {
        firstIndicator[i].style.display = 'none';
    }

});

calculateSheetsButton.addEventListener('click', (event) => {
    console.log("Text")
    event.preventDefault();
    lengthOfSheet = parseFloat(lenOfSheet.value);
    widthOfSheet = parseFloat(widOfSheet.value);
    a = parseFloat(aOfT1.value);
    b = parseFloat(bOfT1.value);
    c = parseFloat(cOfT1.value);
    d = parseFloat(aOfT2.value);
    e = parseFloat(bOfT2.value);
    f = parseFloat(cOfT2.value);
    g = parseFloat(aOfTr.value);
    h = parseFloat(bOfTr.value);
    i = parseFloat(cOfTr.value);

    values = [
        lenOfSheet.value,
        widOfSheet.value,
        aOfT1.value,
        bOfT1.value,
        cOfT1.value,
        aOfT2.value,
        bOfT2.value,
        cOfT2.value,
        aOfTr.value,
        bOfTr.value,
        cOfTr.value
    ]

    let emptyField;
    let invalidField;

    values.map(value => {
        if (value == "") {
            emptyField = true;
        }

        if (value <= 0) {
            invalidField = true;
        }
    });

    if (emptyField) {
        roofContainer.style.border = "2px solid red";
        alert("Please Fill All Fields");
        return;
    }

    if (invalidField) {
        roofContainer.style.border = "2px solid red";
        alert("Values less than or equal to zero are not allowed");
        return;
    }

    roofContainer.style.border = "1px solid rgb(189, 189, 189)";
    resultOfSheets.innerHTML = `${calculateRoofingSheet()} sheets are required`;

})
function copyClipboard(text){
    var input = document.createElement('input');
    input.setAttribute('value',text);
    document.body.appendChild(input);
    input.select();
    var result = document.execCommand('copy');
    document.body.removeChild(input);
    return result;
}