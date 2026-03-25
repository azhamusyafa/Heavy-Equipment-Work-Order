/// <reference path="../.astro/types.d.ts" />
/// <reference types="astro/client" />

interface ImportMetaEnv {
  readonly PUBLIC_API_URL: string
  readonly PUBLIC_API_USERNAME: string
  readonly PUBLIC_API_PASSWORD: string
}

interface ImportMeta {
  readonly env: ImportMetaEnv
}