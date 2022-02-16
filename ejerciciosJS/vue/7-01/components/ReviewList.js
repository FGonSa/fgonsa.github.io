app.component('review-list', {
    props: {
        reviews:{
            type: Array,
            required: true
        }
    },
    template:
    /*html*/
    `
    <div class="review-container">
    <h3>Reseñas:</h3>
    <ul>
    <li v-for="(review, index) in reviews" :key="index">
    {{ review.name }} ha puntuado este producto con {{ review.puntos }} estrellas.
    <br>
    "{{ review.review }}"
    <br>
    <p v-if= "review.recomendar === 'Sí'">{{ review.name }} recomienda este producto.</p>
    <p v-else>{{ review.name }} NO recomienda este producto.</p> <br>
    </li>
    </ul>
    </div>
    `
})