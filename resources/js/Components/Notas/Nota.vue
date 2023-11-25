<template>
  <div>
    <div class="nota" @click="OpenDialog">
      <input class="checkbox" type="checkbox" @click.stop="Select" />
      <svg-icon
        class="delete"
        @click.stop="Delete"
        type="mdi"
        :path="trash_icon"
      ></svg-icon>

      <svg-icon
        class="edit"
        @click.stop="Editar"
        type="mdi"
        :path="edit"
      ></svg-icon>

      <p class="title">{{ item?.title }}</p>
      <p>
        {{ item?.fecha }} - <strong>{{ item?.user?.name }}</strong>
      </p>
      <p class="descripcion">{{ item?.descripcion }}</p>
    </div>

    <dialog class="dialog" :id="item.id">
      <div class="dialog-content">
        <h1 class="title">
          {{ item?.title }}
        </h1>
        <b class="username">{{ item?.user?.name }}</b>
        <p class="fecha">{{ item?.fecha }}</p>
        <p class="descripcion">{{ item?.descripcion }}</p>

        <button class="boton" @click.stop="OpenDialog">Cerrar</button>
      </div>
    </dialog>
  </div>
</template>

<script>
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiTrashCanOutline, mdiPencilOutline } from "@mdi/js";
import { mapActions } from "vuex";
export default {
  props: ["item"],
  data() {
    return {
      dialog: false,
      trash_icon: mdiTrashCanOutline,
      edit: mdiPencilOutline,
    };
  },
  mounted() {
    let dialog = document.getElementById(this.item.id);
    dialog.addEventListener("click", this.HandleDialog);
  },
  methods: {
    ...mapActions(["deleteNotas", "setSelectedNote"]),
    OpenDialog() {
      this.dialog = !this.dialog;
      let dialog = document.getElementById(this.item.id);
      if (this.dialog) dialog.showModal();
      else dialog.close();

      dialog.scrollTo(0, 0);
    },
    HandleDialog(evt) {
      if (
        ![
          "dialog-content",
          "title",
          "fecha",
          "descripcion",
          "username",
        ].includes(evt.target.classList[0])
      )
        document.getElementById(this.item.id).close();
    },
    async Delete() {
      await this.deleteNotas({
        delete_ids: [this.item?.id],
      });
    },
    Select() {
      this.setSelectedNote(this.item);
    },
    Editar() {
      this.$emit("edit", this.item);
    },
  },
  components: {
    SvgIcon,
  },
};
</script>

<style scoped lang="scss">
.nota {
  width: 100%;
  height: fit-content;
  padding: 0.5em 1em;
  //border: 1px solid black;
  box-shadow: 0px 0px 1px 0px black;

  position: relative;

  .delete,
  .checkbox,
  .edit {
    position: absolute;
    right: 0;
    top: 50%;

    transform: translateY(-50%);
    margin-right: 0.5em;

    cursor: pointer;
    transition: 0.2s;
  }

  .delete:hover {
    color: red;
  }

  .checkbox {
    margin-right: 5em;
  }

  .edit {
    margin-right: 2.5em;
  }

  & > .descripcion,
  .title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 20ch;
  }

  .title {
    max-width: 20ch;
    font-weight: bold;
  }
}

.dialog {
  width: 100%;
  height: 80vh;
  background: rgb(255, 255, 255);

  text-align: center;

  overflow-y: scroll;

  .dialog-content {
    height: 100%;
    & > .descripcion {
      width: 90%;
    }
  }

  h1 {
    margin: 1em;
    margin-bottom: 0;
  }

  b,
  p {
    display: block;
    margin: auto;
  }

  .fecha {
    margin-bottom: 2em;
  }

  .boton {
    margin: 1em;
  }
}

@media screen and (min-height: 720px) {
  .dialog {
    width: 70%;
  }
}
</style>