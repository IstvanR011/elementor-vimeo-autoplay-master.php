### 🎬 Elementor & Vimeo UX Master Fix
**Advanced, performance-conscious solution for the "Double-Click" Vimeo bug.**

Most developers avoid MutationObservers due to performance concerns. This script, however, uses a **highly optimized and "metered" approach**:

* **Selective Observation:** It doesn't track every DOM change. It specifically looks for `addedNodes` to detect the exact moment the Elementor Lightbox is rendered.
* **Low Overhead:** The filter for `.elementor-lightbox` is lightning-fast, ensuring zero impact on the main thread or scroll performance.
* **The Result:** A seamless "one-tap" video experience on both Desktop and Mobile, without the bloat of heavy event listeners or constant polling.

**Ideal for:** High-traffic WooCommerce stores and complex Multisite networks where UX and Speed must coexist.
