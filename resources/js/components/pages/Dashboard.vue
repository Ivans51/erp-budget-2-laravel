<template>
  <div class="min-h-screen">
    <!-- Dashboard Content -->
    <div class="py-8 flex-1">
      <div class="w-full px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
          <p class="text-sm text-gray-500 mt-1">
            Overview of your financial metrics and budget performance
          </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Total Budget -->
          <div
            class="card-with-padding hover:shadow-md transition-shadow"
          >
            <div class="flex justify-between items-start mb-4">
              <span class="text-sm font-medium text-gray-600"
                >Total Budget</span
              >
              <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                <Wallet class="h-5 w-5" />
              </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">$1,550,000</h3>
            <p class="text-xs text-gray-500">Annual allocation</p>
          </div>

          <!-- Total Spent -->
          <div
            class="card-with-padding hover:shadow-md transition-shadow"
          >
            <div class="flex justify-between items-start mb-4">
              <span class="text-sm font-medium text-gray-600">Total Spent</span>
              <div class="p-2 bg-green-50 rounded-lg text-green-600">
                <TrendingUp class="h-5 w-5" />
              </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">$566,000</h3>
            <p class="text-xs text-gray-500">Year to date</p>
          </div>

          <!-- Utilization Rate -->
          <div
            class="card-with-padding hover:shadow-md transition-shadow"
          >
            <div class="flex justify-between items-start mb-4">
              <span class="text-sm font-medium text-gray-600"
                >Utilization Rate</span
              >
              <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                <Gauge class="h-5 w-5" />
              </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">36.5%</h3>
            <div class="w-full bg-gray-200 rounded-full h-2">
              <div
                class="bg-gray-900 h-2 rounded-full"
                style="width: 36.5%"
              ></div>
            </div>
          </div>

          <!-- Pending Approvals -->
          <div
            class="card-with-padding hover:shadow-md transition-shadow"
          >
            <div class="flex justify-between items-start mb-4">
              <span class="text-sm font-medium text-gray-600"
                >Pending Approvals</span
              >
              <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                <ClipboardCheck class="h-5 w-5" />
              </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">7</h3>
            <p class="text-xs text-gray-500">Requires action</p>
          </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
          <!-- Main Chart -->
          <div
            class="lg:col-span-2 card-with-padding"
          >
            <h3 class="text-base font-semibold text-gray-900 mb-1">
              Budget vs Actual Spending
            </h3>
            <p class="text-sm text-gray-500 mb-6">
              Monthly comparison for current fiscal year
            </p>

            <!-- CSS Bar Chart Placeholder -->
            <div
              class="h-64 flex items-end justify-between gap-2 sm:gap-4 px-2"
            >
              <!-- Y-axis labels would go here in a real chart -->
              <div
                class="flex flex-col items-center gap-2 w-full group"
                v-for="(month, index) in months"
                :key="index"
              >
                <div
                  class="w-full flex justify-center items-end gap-1 h-full relative"
                >
                  <!-- Grid lines background -->
                  <div
                    class="absolute inset-0 border-b border-gray-100"
                    style="bottom: 0%"
                  ></div>
                  <div
                    class="absolute inset-0 border-b border-gray-100"
                    style="bottom: 25%"
                  ></div>
                  <div
                    class="absolute inset-0 border-b border-gray-100"
                    style="bottom: 50%"
                  ></div>
                  <div
                    class="absolute inset-0 border-b border-gray-100"
                    style="bottom: 75%"
                  ></div>
                  <div
                    class="absolute inset-0 border-b border-gray-100"
                    style="bottom: 100%"
                  ></div>

                  <!-- Bars -->
                  <div
                    class="w-3 sm:w-6 bg-blue-500 rounded-t-sm transition-all duration-500 hover:bg-blue-600"
                    :style="{ height: month.budget + '%' }"
                  ></div>
                  <div
                    class="w-3 sm:w-6 bg-emerald-500 rounded-t-sm transition-all duration-500 hover:bg-emerald-600"
                    :style="{ height: month.actual + '%' }"
                  ></div>
                </div>
                <span class="text-xs text-gray-500">{{ month.name }}</span>
              </div>
            </div>

            <!-- Legend -->
            <div class="flex justify-center gap-6 mt-6">
              <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-emerald-500 rounded-sm"></div>
                <span class="text-sm text-gray-600">Actual</span>
              </div>
              <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-blue-500 rounded-sm"></div>
                <span class="text-sm text-gray-600">Budget</span>
              </div>
            </div>
          </div>

          <!-- Pie Chart -->
          <div class="card-with-padding">
            <h3 class="text-base font-semibold text-gray-900 mb-1">
              Budget by Department
            </h3>
            <p class="text-sm text-gray-500 mb-6">Annual budget allocation</p>

            <div class="relative h-64 w-full flex items-center justify-center">
              <!-- CSS Conic Gradient Pie Chart -->
              <div
                class="w-48 h-48 rounded-full relative"
                style="
                  background: conic-gradient(
                    #3b82f6 0% 35%,
                    #ef4444 35% 55%,
                    #f59e0b 55% 70%,
                    #10b981 70% 90%,
                    #8b5cf6 90% 100%
                  );
                "
              >
                <div
                  class="absolute inset-0 m-auto w-24 h-24 bg-white rounded-full"
                ></div>
              </div>

              <!-- Labels positioned absolutely for visual effect -->
              <div
                class="absolute top-4 right-4 text-xs text-blue-600 font-medium"
              >
                IT
              </div>
              <div
                class="absolute bottom-12 right-2 text-xs text-red-500 font-medium"
              >
                Sales
              </div>
              <div
                class="absolute bottom-4 left-12 text-xs text-orange-500 font-medium"
              >
                HR
              </div>
              <div
                class="absolute top-1/2 left-2 text-xs text-emerald-500 font-medium"
              >
                Operations
              </div>
              <div
                class="absolute top-8 left-8 text-xs text-purple-500 font-medium"
              >
                Marketing
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Expenses -->
        <div
          class="card-with-padding"
        >
          <div class="pb-6 border-b border-gray-100">
            <h3 class="text-base font-semibold text-gray-900">
              Recent Expenses
            </h3>
            <p class="text-sm text-gray-500">
              Latest expense submissions and their status
            </p>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-left">
              <tbody class="divide-y divide-gray-100">
                <tr
                  v-for="expense in recentExpenses"
                  :key="expense.id"
                  class="hover:bg-gray-50 transition-colors"
                >
                  <td class="py-4">
                    <div class="flex items-center gap-3">
                      <div class="p-2 rounded-lg bg-gray-50 text-gray-600">
                        <FileText class="h-5 w-5" />
                      </div>
                      <div>
                        <p class="text-sm font-medium text-gray-900">
                          {{ expense.title }}
                        </p>
                        <p class="text-xs text-gray-500">
                          {{ expense.department }} • {{ expense.date }}
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="py-4 text-right">
                    <p class="text-sm font-medium text-gray-900">
                      ${{ expense.amount.toLocaleString() }}
                    </p>
                  </td>
                  <td class="py-4 text-right">
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                      :class="{
                        'bg-green-100 text-green-800':
                          expense.status === 'approved',
                        'bg-yellow-100 text-yellow-800':
                          expense.status === 'pending',
                        'bg-red-100 text-red-800':
                          expense.status === 'rejected',
                      }"
                    >
                      {{ expense.status }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import {
  Wallet,
  TrendingUp,
  Gauge,
  ClipboardCheck,
  FileText,
} from "lucide-vue-next";

const months = [
  { name: "Jan", budget: 80, actual: 65 },
  { name: "Feb", budget: 80, actual: 75 },
  { name: "Mar", budget: 80, actual: 55 },
  { name: "Apr", budget: 80, actual: 78 },
  { name: "May", budget: 80, actual: 85 },
  { name: "Jun", budget: 80, actual: 60 },
];

const recentExpenses = ref([
  {
    id: 1,
    title: "Cloud Infrastructure",
    department: "IT",
    date: "2025-11-15",
    amount: 12500,
    status: "approved",
  },
  {
    id: 2,
    title: "Q4 Marketing Campaign",
    department: "Marketing",
    date: "2025-11-14",
    amount: 45000,
    status: "pending",
  },
  {
    id: 3,
    title: "Office Supplies",
    department: "Operations",
    date: "2025-11-12",
    amount: 1200,
    status: "approved",
  },
  {
    id: 4,
    title: "Team Building Event",
    department: "HR",
    date: "2025-11-10",
    amount: 3500,
    status: "rejected",
  },
  {
    id: 5,
    title: "Software Licenses",
    department: "IT",
    date: "2025-11-08",
    amount: 8900,
    status: "approved",
  },
]);
</script>

<style scoped>
/* Custom styles for charts if needed */
</style>
