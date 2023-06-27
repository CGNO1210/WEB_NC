const chapters = document.querySelectorAll('.chapter')
chapters.forEach((chapter) =>{
    var chaptername = chapter.querySelector('.chaptername')
    chaptername.onclick = () => {
        if(chapter.querySelector('.lessons').style['display'] == 'none'){
            chapter.querySelector('.lessons').style['display'] = 'block'
        }
        else{
            chapter.querySelector('.lessons').style['display'] = 'none'
        }
    }
})
