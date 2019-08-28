const utilisateurs = document.getElementById('utilisateurs');

if(utilisateurs){
    utilisateurs.addEventListener('click', e=>{
        if(confirm('voulez-vous vraiment supprimer cet éléve ?')){
            const id = e.target.getAttribute('data-id');
            fetch(`/Suppression/${id}`, {method:'DELETE'}).then(res => window.location.reload())
        }
    });
}