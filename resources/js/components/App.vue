<template>
    <Suspense>
        <Todos />
    </Suspense>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import Todos from "./Todos.vue";

export default defineComponent({
    components: {
        Todos,
    },
});
</script>
