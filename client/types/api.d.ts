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

export interface Skill {
  id: number
  name: string
  strength: number
}

export interface Bio {
  id: number
  first_name: string
  last_name: string
  email: string
  location: string
  headline: string
  professional_summary: string
  myvalues: string
  github_url: string
  linkedin_url: string
  interests: any
}

export interface Experiencies {
  id: number
  company_name: string
  position: string
  responsibilities: any
  start_date: string
  end_date: string
  is_current_position: boolean
}

export type Users = Array<User>
export type Skills = Array<Skill>
export type BioData = Array<Bio>
export type Experience = Array<Experiencies>
