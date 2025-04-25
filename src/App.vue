<template>
  <div>
    <h2 class="text-xl font-bold mb-4">CRM Сущности</h2>
    <table class="table-auto w-full border">
      <thead>
        <tr>
          <th class="border px-2 py-1">Дата создания</th>
          <th class="border px-2 py-1">Сущность</th>
          <th class="border px-2 py-1">Название</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in entities" :key="item.created + item.title">
          <td class="border px-2 py-1">{{ item.created }}</td>
          <td class="border px-2 py-1">{{ item.type }}</td>
          <td class="border px-2 py-1">{{ item.title }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const entities = ref([]);

onMounted(async () => {
  const res = await fetch("/bitrix/admin/ajax_crm_entities.php");
  entities.value = await res.json();
});
</script>
