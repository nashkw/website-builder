<script setup>
import StarRating from 'vue-star-rating'

const props = defineProps({
    quote: {
        type: String,
        required: true,
    },
    reviewer: {
        type: String,
        required: true,
    },
    date: {
        type: String,
        required: false,
    },
    rating: {
        type: Number,
        required: false,
    },
});
</script>

<template>
    <div class="gs-card space-y-6">
        <p class="">
            <em>"{{ quote }}"</em>
        </p>
        <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-end gap-6">
            <div class="flex justify-end gs-footer-item opacity-75">
                <p>
                    {{ reviewer }}
                </p>
                <p
                    v-if="date"
                    class="opacity-50"
                >
                    |
                </p>
                <p v-if="date">
                    {{ date }}
                </p>
            </div>
            <StarRating
                v-if="rating"
                :rating="rating / 2"
                :read-only="true"
                :increment="0.5"
                :show-rating="false"
                :star-size="30"
                inactive-color="#BBBBBB"
                active-color="#222222"
                class="max-sm:order-first"
            />
        </div>
    </div>
</template>
