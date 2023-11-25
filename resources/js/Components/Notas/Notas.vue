<template>
  <div class="notas">
    <div class="formulario">
      <input type="text" placeholder="Titulo nota" v-model="titulo" />
      <textarea
        cols="30"
        rows="10"
        placeholder="DESCRIPCION DE LA NOTA"
        v-model="descripcion"
      ></textarea>
      <a class="boton" @click="Guardar">GUARDAR</a>
      <a class="boton" @click="Delete">ELIMINAR</a>
    </div>

    <div class="notas-container">
      <Nota
        v-for="(nota, index) in notas"
        :key="index"
        :item="nota"
        @edit="Editar"
      ></Nota>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Nota from "./Nota.vue";

export default {
  async mounted() {
    await this.getNotas();
  },
  data() {
    return {
      id: null,
      titulo: "",
      descripcion: "",
    };
  },
  methods: {
    ...mapActions(["getNotas", "storeNotas", "deleteNotas"]),
    Guardar() {
      this.storeNotas({
        id: this.id,
        titulo: this.titulo,
        descripcion: this.descripcion,
      });
      this.id = null;
      this.titulo = "";
      this.descripcion = "";
    },
    Editar(item) {
      this.id = item.id;
      this.titulo = item.title;
      this.descripcion = item.descripcion;
    },
    Delete() {
      this.deleteNotas({
        delete_ids: this.selectedNotes.map((x) => x.id),
      });
    },
  },
  computed: {
    ...mapGetters(["notas", "selectedNotes"]),
  },
  components: {
    Nota,
  },
};
</script>

<style lang="scss" scoped>
.notas,
.formulario {
  display: flex;
}

.formulario {
  width: 30%;
}

.notas {
  width: 90%;
  padding: 2em 0;
  margin: auto;
  justify-content: space-evenly;

  input,
  textarea {
    margin: 0.5em 0;
    resize: none;
  }

  a {
    width: 50%;
    margin: 0.5em auto;
    display: block;
    text-align: center;
  }
}

.notas-container {
  width: 30%;
  max-height: 73vh;
  overflow-y: scroll;

  box-shadow: 0px 0px 1px 0px black;

  &::-webkit-scrollbar {
    display: none;
  }
}

.formulario {
  flex-direction: column;
}

@media screen and (max-width: 1000px) {
  .formulario {
    width: 100%;
    margin-bottom: 1em;
  }
  .notas {
    flex-direction: column;
    a {
      margin-bottom: .5em;
    }
  }
  .notas-container {
    width: 100%;
  }
}
</style>