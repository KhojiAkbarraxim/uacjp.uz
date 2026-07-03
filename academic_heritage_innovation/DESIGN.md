---
name: Academic Heritage & Innovation
colors:
  surface: '#f7f9fc'
  surface-dim: '#d8dadd'
  surface-bright: '#f7f9fc'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f4f7'
  surface-container: '#eceef1'
  surface-container-high: '#e6e8eb'
  surface-container-highest: '#e0e3e6'
  on-surface: '#191c1e'
  on-surface-variant: '#43474f'
  inverse-surface: '#2d3133'
  inverse-on-surface: '#eff1f4'
  outline: '#737780'
  outline-variant: '#c3c6d1'
  surface-tint: '#3a5f94'
  primary: '#001e40'
  on-primary: '#ffffff'
  primary-container: '#003366'
  on-primary-container: '#799dd6'
  inverse-primary: '#a7c8ff'
  secondary: '#1b6d24'
  on-secondary: '#ffffff'
  secondary-container: '#a0f399'
  on-secondary-container: '#217128'
  tertiary: '#735c00'
  on-tertiary: '#ffffff'
  tertiary-container: '#cca830'
  on-tertiary-container: '#4f3e00'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d5e3ff'
  primary-fixed-dim: '#a7c8ff'
  on-primary-fixed: '#001b3c'
  on-primary-fixed-variant: '#1f477b'
  secondary-fixed: '#a3f69c'
  secondary-fixed-dim: '#88d982'
  on-secondary-fixed: '#002204'
  on-secondary-fixed-variant: '#005312'
  tertiary-fixed: '#ffe088'
  tertiary-fixed-dim: '#e9c349'
  on-tertiary-fixed: '#241a00'
  on-tertiary-fixed-variant: '#574500'
  background: '#f7f9fc'
  on-background: '#191c1e'
  surface-variant: '#e0e3e6'
typography:
  display-lg:
    fontFamily: Playfair Display
    fontSize: 40px
    fontWeight: '700'
    lineHeight: 48px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Playfair Display
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: Playfair Display
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 36px
  headline-md:
    fontFamily: Playfair Display
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  unit: 4px
  container-margin: 20px
  gutter: 16px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
---

## Brand & Style
The design system is rooted in the intersection of academic tradition and modern scholarly collaboration. It serves the Uzbek Academic Club in Japan, balancing the prestigious, authoritative weight of global academia with the forward-thinking energy of international research.

The aesthetic follows a **Modern Corporate** approach with **Minimalist** layouts. It prioritizes clarity, intellectual rigor, and cross-cultural bridge-building. The emotional response should be one of "Trusted Excellence"—evoking the feeling of an established institution that is nonetheless accessible and technologically adept. High contrast and generous whitespace ensure that dense academic content remains legible and prestigious.

## Colors
The palette is a symbolic blend of national identity and academic stability. 

- **Primary (Deep Academic Blue):** Used for headers, primary buttons, and navigational elements to establish authority.
- **Secondary (Scholar Green):** Represents growth and vitality; used for success states, active indicators, and secondary calls to action.
- **Accent (Gold):** Reserved for highlights, badges of excellence, and subtle borders to signify credibility and high achievement.
- **Neutral (Soft Gray & Slate):** The Soft Gray provides a clean, non-distracting canvas, while Slate Blue ensures text maintains high readability without the harshness of pure black.

## Typography
The typographic hierarchy relies on a "Transitional Serif" for titles to provide a literary and authoritative voice. This is paired with a highly functional "Geometric Sans" for body text to ensure maximum readability on mobile devices.

- **Headlines:** Use Playfair Display. It should feel editorial. For Japanese text integration, use a high-quality Mincho fallback to maintain the serif profile.
- **Body & Labels:** Use Inter. Its large x-height and neutral character make it ideal for research papers, directory listings, and event details. 
- **Bilingual Treatment:** When English and Japanese/Uzbek appear together, the English should use the primary font tokens, while the secondary language inherits the same weight and scaling for visual parity.

## Layout & Spacing
The layout follows a **Fluid Grid** optimized for mobile-first consumption. 

- **Grid:** A 4-column mobile grid with 20px side margins. 
- **Rhythm:** An 8px linear scale drives vertical rhythm. Components should use `stack-md` (16px) for internal grouping and `stack-lg` (32px) to separate distinct content sections.
- **Whitespace:** Emphasize "Scholar's Margin"—generous top and bottom padding (min 48px) for section headers to allow the eye to rest, reflecting an organized and calm academic environment.

## Elevation & Depth
Depth is signaled through **Tonal Layers** and extremely **Ambient Shadows**.

- **Surfaces:** The base background is `#F5F7FA`. Cards and elevated containers use pure `#FFFFFF`.
- **Shadows:** Use a "Paper Depth" shadow—very low opacity (4-8%), large blur (16px+), and a slight vertical offset (4px). This makes cards appear to sit naturally on a desk.
- **Dividers:** Use 1px hairlines in a lightened Slate Blue (10% opacity) for subtle separation without breaking the flow of the page.

## Shapes
The shape language is **Soft (0.25rem)**, leaning towards a structured, professional appearance rather than a playful one.

- **Cards & Inputs:** 4px (0.25rem) corner radius. This provides a hint of modern approachability while maintaining a serious, "square" academic profile.
- **Buttons:** 4px radius. Avoid pill shapes to keep the design grounded in professional standards.
- **Patterns:** Incorporate subtle, low-contrast geometric patterns (Uzbek Girih) as background watermarks or within header containers to celebrate cultural heritage.

## Components

- **Buttons:** Primary buttons use Deep Academic Blue with white text. Secondary buttons use a Scholar Green outline. High-priority "Join" or "Apply" actions can utilize the Gold accent as a top-border or small indicator icon.
- **Cards:** Clean white backgrounds with 4px rounded corners and a soft ambient shadow. Include a "Scholar Green" 2px left-border for featured research or active events.
- **Chips/Tags:** Used for academic disciplines (e.g., "STEM", "Humanities"). Use light gray backgrounds with Slate Blue text; no shadows.
- **Input Fields:** Solid 1px Slate Blue border (20% opacity). On focus, the border transitions to Deep Academic Blue with a 2px thickness.
- **Lists:** Use custom bullet points inspired by geometric Uzbek star motifs in Gold to elevate standard text lists.
- **Navigation:** A bottom navigation bar for mobile with clear, minimalist icons and a "Secondary Green" indicator for the active state.