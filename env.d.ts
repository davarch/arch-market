interface ImportMetaEnv extends Readonly<Record<string, string>> {
    readonly VITE_BASE_URL: string
    // more env variables...
}

interface ImportMeta {
    url: string
    readonly hot?: import('./hot').ViteHotContext
    readonly env: ImportMetaEnv
    glob: import('./importGlob').ImportGlobFunction
}
