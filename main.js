const addContract = document.querySelector('.addContract');
const addClient = document.querySelector('#addClient');
const addCar = document.querySelector('#addCar');
const addContractButton = document.querySelector('#addContractBtn');
// const rightSide = document.querySelector('.right-bar');

addCar.addEventListener('submit', (e)=>{
    e.preventDefault();
    addContract.style.display = 'flex';
})

addContractButton.addEventListener('click', ()=>{
    document.querySelector('.Info').style.display = 'none';
    addContract.style.display = 'flex';

})
addContract.addEventListener('submit', ()=>{
    // addContract.style = 'display:none;';
    })
    const clientIDSelect = document.querySelector('#clientID')
    clientIDSelect.onchange = ()=>{
        if(clientIDSelect.value== 'addClient'){
            addClient.style.display = 'flex';
            addContract.style.display = 'none';
            
    };
}
const addClientForm = document.querySelector('#add-client');
addClientForm.addEventListener('submit', (e)=>{
    // e.preventDefault();
    
    // const newClientOption = document.createElement('option');
    // newClientOption.text = addClientForm.elements.clientName.value;
    // newClientOption.value = addClientForm.elements.clientID.value;
    // clientIDSelect.appendChild(newClientOption);
    addClientForm.reset();  
    addContract.style.display = 'flex';
    addClient.style.display = 'none';

})