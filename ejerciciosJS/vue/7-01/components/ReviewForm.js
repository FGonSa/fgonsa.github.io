app.component('review-form', {
    template:
        /*html*/

        `
        <!-- Añadimos un listener que active el envio del form y evite el refresh del navegador-->
    <form class="review-form" @submit.prevent="onSumbit">
    <h3>Deja una reseña</h3>
    <label for="name">Nombre:</label>
        <!-- Enlazamos el input con el data-->
    <input id="name" v-model="name">

    <label for="review">Reseña:</label>
        <!-- Enlazamos el textarea con el data-->
    <textarea id="review" v-model="review"></textarea>

    <label for="puntos">Puntuación:</label>
    <!-- Enlazamos el select con el data y lo pasamos a number-->
    <select id="puntos" v-model.number="puntos"> 
    <option>5</option>
    <option>4</option>
    <option>3</option>
    <option>2</option>
    <option>1</option>
    </select><br>

    <!-- Enlazamos el recomendar con el data-->
    <label for="recomendar">Recomendarías este producto?</label>
        <label>
            Sí
        <input type="radio" value="Sí" v-model="recomendar"/>
    </label>
    <label>
        No
    <input type="radio" value="No" v-model="recomendar"/>
    </label>

  <!-- Botón de enviar-->
    <input class="button" type="submit" value="Enviar">
    </form>`,

    data() {
        return {
            name: "",
            review: "",
            puntos: null,
            recomendar: null
        }
    },
    methods: {
        onSumbit() {

            //Validación
            if (this.name === '' || this.review === '' || this.puntos === null || this.recomendar === null) {
                alert('Por favor, rellena cada campo de la reseña.')
                return
            }
            //Creamos un objeto con los datos del formulario
            let productReview = {
                name: this.name,
                review: this.review,
                puntos: this.puntos,
                recomendar: this.recomendar
            }

            //Enviamos el formulario
            this.$emit('review-enviada', productReview);

            //Reiniciamos los valores para el siguiente formulario
            this.name = "",
                this.review = "",
                this.puntos = null
            this.recomendar = null
        }
    }
})