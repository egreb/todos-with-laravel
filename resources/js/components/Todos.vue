<template>
    <div class="flex flex-col container max-w-md mx-auto">
        <h1 class="text-4xl py-4 text-center">Todos!</h1>

        <div class="flex flex-col py-4">
            <div class="flex flex-1">
                <input
                    type="text"
                    v-model="name"
                    placeholder="What needs to be done"
                    class="p-2 placeholder:text-gray-300 font-semibold rounded-l-md rounded-r-none w-full border border-gray-300"
                />
                <button
                    @click="store"
                    type="button"
                    class="p-2 rounded-l-none rounded-r-md bg-emerald-400 hover:bg-emerald-500 text-white font-bold border border-gray-300"
                >
                    Submit
                </button>
            </div>
        </div>
        <ul class="flex flex-col pt-2 pb-10 gap-y-2">
            <li
                v-for="(todo, index) in todos"
                :key="index"
                class="border border-gray-300 rounded-md p-4 shadow-md bg-white"
            >
                <span
                    class="text-xl font-bold"
                    :class="{ 'line-through': todo.done }"
                    >{{ todo.title }}</span
                >
            </li>
        </ul>
    </div>
</template>

<script lang="ts">
import { Todo } from "../types/Todo";
import { defineComponent } from "vue";

export default defineComponent({
    data() {
        return {
            name: "" as String | null,
            todos: [] as Array<Todo>,
        };
    },
    methods: {
        async store(event: FormDataEvent) {
            event.preventDefault();

            const csrf = document.querySelector(
                'meta[name="csrf-token"]'
            ) as HTMLMetaElement;
            const res = await fetch("/api/todo/store", {
                method: "POST",
                body: JSON.stringify({ title: this.name }),
                headers: {
                    "X-CSRF-TOKEN": csrf.content,
                    "content-type": "application/json",
                },
            }).catch((error) => {
                console.log("error", error);
            });

            if (res) {
                const json = await res.json();
                this.todos.unshift(json);
            }
        },
    },
    async mounted() {
        const json = await fetch("/api/todo").then((res) => res.json());

        this.todos = json;
    },
});
</script>
