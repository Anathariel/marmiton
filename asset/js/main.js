const searchForm = document.getElementById('search-form');
const inputSearch = document.getElementById('input-search');

searchForm.addEventListener('submit', function(walesca){

    walesca.preventDefault();

})

inputSearch.addEventListener('input', function(walesca){

    walesca.preventDefault();

    if(inputSearch.value.length > 2){
        let formDatas = new FormData(searchForm);

        fetch('./search', {
            method: 'POST',
            body: formDatas
        })
            .then(response => response.json())
            .then(datas => console.log(datas))

    }

})