
export interface MetApiResponse {
  benchmark: number
  status: 'success' | 'failure'
  query: {
    options: Record<string, any>
    params: Record<string, any>
  }
  paginate?: {
    current_page: number
    first_item: number
    last_item: number
    last_page: number
    pages: Array<number>
    per_page: number
    total: number
  }
  data: any
}

export interface User {
  name: string
  job: string
  email: string
  phone: string
  avatar: string
}

export type Users = Array<User>

export interface Resume {
  resume_id: number
  full_name: string
  email: string
  phone: string
  role: string
  about: string
}

export interface Link {
  name: string
  url: string
}

export interface Language {
  code: string
  name: string
  level: string
}

export interface Interest {
  name: string
}

export interface Skill {
  name: string
  years?: string
  order?: string
}

export type Skills = Array<Skill>

export interface Experience {
  company: string
  role: string
  date_start: string
  date_end: string
  description: string
  skills: Array<Skill>
}
