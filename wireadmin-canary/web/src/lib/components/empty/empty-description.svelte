<script lang="ts">
  import type { HTMLAttributes } from 'svelte/elements';
  import { cn } from '$lib/utils';

  type $$Props = HTMLAttributes<HTMLDivElement>;

  let className: $$Props['class'] = undefined;
  export { className as class };
</script>

<div class={cn('text-black/50 dark:text-white/50', className)} {...$$restProps}>
  <slot />
</div>
