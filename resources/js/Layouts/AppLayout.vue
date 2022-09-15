<script setup>
// Core
import {ref} from 'vue';
import {Inertia} from '@inertiajs/inertia';
import {Head} from '@inertiajs/inertia-vue3';

// Components
import Notification from '@/Components/Notification.vue';
import Nav from '@/Components/Navigation/Nav.vue';
import TeamsDropdown from '@/Components/Teams/TeamsDropdown.vue';
import MobileNav from '@/Components/Navigation/Mobile/MobileNav.vue';
import ProfileButton from '@/Components/Navigation/ProfileButton.vue';
import BurgerButton from '@/Components/Navigation/Mobile/BurgerButton.vue';

// Helpers
import {
  ordinal,
  greeting,
} from '@/helpers/index.js';


const date = new Date();
let mobileMenuOpen = ref(false);

defineProps({
  title: String,
});


const logout = () => {
  Inertia.post(route('logout'));
};
</script>

<template>
  <div class="bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200">
    <Head :title="title"/>

    <MobileNav
        class="md:hidden"
        :mobileMenuOpen="mobileMenuOpen"
        @toggle-mobile-menu="mobileMenuOpen = !mobileMenuOpen"
    />

    <div class="min-h-screen flex">
      <div class="flex grow">
        <!-- Left Navigation -->
        <Nav
            class="hidden md:flex"
        />

        <div class="flex flex-col grow">
          <!-- Page Header: Greeting and Mobile Burger Menu -->
          <nav
              class="sticky top-0 w-full bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 z-40">
            <div class="flex items-center justify-between space-x-4 h-16 px-4 sm:px-6 lg:px-8">
              <div>
                <!-- Greeting -->
                <div class="flex flex-col items-start">
                  <p class="font-semibold text-slate-900 dark:text-slate-100">
                    {{ greeting($page.props.user.name) }}
                  </p>

                  <p class="text-xs text-slate-500 dark:text-slate-400">
                    {{ date.toLocaleDateString(undefined, {weekday: 'long'}) }}
                    {{ date.toLocaleDateString(undefined, {day: 'numeric'}) }}<sup>{{ ordinal(date.getDate()) }}</sup>
                    {{ date.toLocaleDateString(undefined, {month: 'long'}) }}
                  </p>
                </div>
              </div>

              <div class="flex items-center justify-between space-x-3">
                <!-- Team Management  -->
                <TeamsDropdown v-show="$page.props.user.role === 1"/>

                <!-- Profile  -->
                <ProfileButton/>

                <!-- Mobile Menu Trigger -->
                <BurgerButton
                    class="md:hidden"
                    :mobileMenuOpen="mobileMenuOpen"
                    @toggle-mobile-menu="mobileMenuOpen = !mobileMenuOpen"
                />
              </div>
            </div>
          </nav>

          <header v-if="$slots.header">
            <slot name="header"/>
          </header>

          <!-- Page Content -->
          <main>
            <Notification />
            <slot/>
          </main>
        </div>
      </div>
    </div>
  </div>
</template>
