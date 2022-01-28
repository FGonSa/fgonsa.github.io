//Creamos una plantilla HTML
const template = document.createElement("template");
let total = document.getElementById("total");
let suma = 0;

//Dentro de la plantilla situamos la estructura del componente
template.innerHTML = `
<link rel="stylesheet" href="./Components/Card/Card_style.css">
<div class= "item-card">
<img  width="120px" height="100px"/>
<div class="item-name" id="id-!!!">
<h3></h3>
</div>
<div class="item-price">
<h4></h4>
</div>
<div class="item-btn">
<button id="btn-???">+INFO</button>
</div>
<div class="item-btn-purchase">
<button id="btn-purchase">COMPRAR</button>
</div>
</div>
<div class="item-bio"></div>`;

/**
 * * Para crear el componente, creamos un objeto.
 * * Convertimos el objeto en un tag HTML con el extends HTMLElement
 */
class ItemCard extends HTMLElement {
  constructor() {
    super();

    //creamos un Shadow DOM -> nos devuelve Shadow Root
    this.attachShadow({ mode: "open" });
    this.shadowRoot.appendChild(template.content.cloneNode(true));
    let name = (this.shadowRoot.querySelector("h3").innerText =
      this.getAttribute("name"));
    this.shadowRoot.querySelector("img").src = this.getAttribute("avatar");
    let precio = (this.shadowRoot.querySelector("h4").innerText =
      this.getAttribute("precio") + "€");

    let newId = "id-" + name;

    let btn = this.shadowRoot.getElementById("btn-???");
    btn.id = newId;

    this.shadowRoot.getElementById(newId).addEventListener("click", () => {
      document.getElementById("info").innerText = JSON.stringify(info());
    });

    this.shadowRoot
      .getElementById("btn-purchase")
      .addEventListener("click", () => {
        precio = parseFloat(precio);
        suma = suma + precio;

        document.getElementById("total").innerText = suma;
      });

    function info() {
      let bio;

      if ((name == "Agua")) {
        bio = "Botella de Agua Mineral. Mineralización muy débil.";
      } else if ((name == "Pizza")) {
        bio = "Pizza de pepperoni cocinada por Luigi.";
      } else {
        bio = "Solomillo de ternera con guarnición.";
      }
      return {
        Nombre: name,
        Precio: precio,
        Descripcion: bio,
      };
    }
  }
}

//Esto me permite crear una tag y enlazarle el Componente
window.customElements.define("item-card", ItemCard);
