import fg from "fast-glob";
import fs from "fs-extra";

// familles de classes Tailwind (à compléter si besoin)
const tailwindPrefixes = [
  "m", "mt", "mb", "ml", "mr", "mx", "my",
  "p", "pt", "pb", "pl", "pr", "px", "py",
  "w", "h", "min-w", "min-h", "max-w", "max-h",
  "flex", "grid", "gap", "items", "justify",
  "text-xs", "text-sm", "text-base", "text-lg", "text-xl",
  "text-2xl", "text-3xl", "text-4xl", "text-5xl", "text-6xl",
  "font-thin", "font-light", "font-medium", "font-semibold", "font-bold", "font-black",
  "leading-", "tracking-",
  "rounded", "rounded-", "shadow", "shadow-",
  "overflow-", "z-", "absolute", "relative", "fixed", "sticky",
  "top-", "bottom-", "left-", "right-",
  "inset-", "translate-", "scale-", "rotate-", "skew-",
  "bg-", "from-", "via-", "to-", "ring-", "placeholder-",
  "hidden", "block", "inline", "inline-block", "flex", "grid"
];

// Regex dynamique
const regex = new RegExp(`\\b(${tailwindPrefixes.join("|")})([a-z0-9-]*)\\b`, "g");

async function processFiles() {
  // Chercher tous les fichiers Blade, Vue, JS
  const files = await fg([
    "resources/views/**/*.blade.php",
    "resources/js/**/*.js",
    "resources/js/**/*.vue",
  ]);

  for (const file of files) {
    let content = await fs.readFile(file, "utf8");

    // Remplacer uniquement si la classe n'a pas déjà "tw-"
    const updated = content.replace(regex, (match) => {
      if (match.startsWith("tw-")) return match; // déjà prefixé
      return "tw-" + match;
    });

    if (updated !== content) {
      await fs.writeFile(file, updated, "utf8");
      console.log(`✅ Prefix applied in ${file}`);
    }
  }
}

processFiles();
